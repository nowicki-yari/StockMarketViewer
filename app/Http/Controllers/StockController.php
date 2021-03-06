<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Exchange;
use App\Models\Stock;
use Artisaninweb\SoapWrapper\SoapWrapper;

class StockController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->middleware('auth');
        $this->soapWrapper = $soapWrapper;
    }

    public function getStocksFromExchange($exchange) {
        //Gets session data if it exists
        [$user, $fav] = $this->retrieve_session_data();

        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('StockListFromExchange', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Stock::class
                ]);
        });

        $data = ['exchange' => $exchange];
        $response = $soapWrapper->call('StockListFromExchange.GetStocksFromExchange', [$data]);

        return view("stocks")
            ->with("stocks",$response->GetStocksFromExchangeResult->Stock)
            ->with('exchange', $exchange)
            ->with("favorites", $fav)
            ->with("user", $user);
    }

    public function getStocksFromIndustry($sector, $industry) {
        //Gets session data if it exists
        [$user, $fav] = $this->retrieve_session_data();
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('StockListFromIndustry', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Stock::class
                ]);
        });

        $data = ['industry' => $industry];
        $response = $soapWrapper->call('StockListFromIndustry.GetStocksFromIndustry', [$data]);

        return view("stocks")
            ->with("stocks",$response->GetStocksFromIndustryResult->Stock)
            ->with('industry', $industry)
            ->with("favorites", $fav)
            ->with("user", $user);
    }

    public function getInfo($exchange, $stock) {
        [$user, $fav] = $this->retrieve_session_data();
        $data = Http::get("http://127.0.0.1:5000/stock/" . $stock . "/info")->json();
        return view("stock_overview")
            ->with('exchange', $exchange)
            ->with('info', json_decode($data, true))
            ->with("favorites", $fav)
            ->with("user", $user);
    }

    public function retrieve_session_data(): array
    {
        $user = "";
        $fav = [];
        if (session()->has('favorites')) {
            $fav = session('favorites');
        }
        if (session()->has('user')) {
            $user = session('user');
        }
        return [$user, $fav];
    }
}
