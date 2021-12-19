<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->soapWrapper = $soapWrapper;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //Gets user that is loged in + their favorite stocks (as input for soap call)
        $user = Auth::user();
        $data = ['stocks' => $this->prepare_input_favorites($user)];
        $fav = [];

        //Get list of exchanges
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('ExchangeList', function ($service) {
           $service
           ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
           ->trace(true)
           ->classmap([
               Exchange::class
           ]);
        });

        $favorites = $soapWrapper->call('ExchangeList.GetStocks', [$data]);
        $exchanges = $soapWrapper->call('ExchangeList.GetExchanges', [new Exchange()]);
        $sectors = $soapWrapper->call('ExchangeList.GetListOfSectors', []);

        if((array) $favorites != null) {
            if (gettype($favorites->GetStocksResult->Stock) == 'object') {
                $fav = [$favorites->GetStocksResult->Stock];
            } else {
                $fav = $favorites->GetStocksResult->Stock;
            }
        }

        session()->put('favorites', $fav);
        session()->put('user', $user);

        return view("exchange")
            ->with("exchanges", $exchanges->GetExchangesResult->Exchange)
            ->with("sectors", $sectors->GetListOfSectorsResult->string)
            ->with("user", $user)
            ->with("favorites", $fav);
    }

    public function prepare_input_favorites($user): string
    {
        return implode(",", array_filter([
            $user->favorite_1,
            $user->favorite_2,
            $user->favorite_3,
            $user->favorite_4,
            $user->favorite_5
        ]));
    }
}


