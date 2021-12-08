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
        $this->soapWrapper = $soapWrapper;
    }

    public function getStocksFromExchange($exchange) {
        /*
        $allStocks= Stock::all()
            ->where('exchange','==', $exchange);
        return view("stocks")->with("stocks",$allStocks)->with('exchange', $exchange);
        */
        $data = ['exchange' => $exchange];
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('StockListFromExchange', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Stock::class
                ]);
        });

        $response = $soapWrapper->call('StockListFromExchange.GetStocksFromExchange', [
            $data
        ]);
        return view("stocks")->with("stocks",$response->GetStocksFromExchangeResult->Stock)->with('exchange', $exchange);
    }

    public function getStocksFromIndustry($sector, $industry) {
        $data = ['industry' => $industry];
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('StockListFromIndustry', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Stock::class
                ]);
        });

        $response = $soapWrapper->call('StockListFromIndustry.GetStocksFromIndustry', [
            $data
        ]);
        return view("stocks")->with("stocks",$response->GetStocksFromIndustryResult->Stock)->with('industry', $industry);
    }

    public function getInfo($exchange, $stock) {
        $data = Http::get("http://127.0.0.1:5000/stock/" . $stock . "/info")->json();
        return view("stock_overview")->with('exchange', $exchange)->with('info', json_decode($data, true));
    }
}
