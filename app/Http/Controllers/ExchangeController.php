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
        $this->soapWrapper = $soapWrapper;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        /*
        $allExchanges= Exchange::all();
        return view("exchange")->with("exchanges",$allExchanges);
        */
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('ExchangeList', function ($service) {
           $service
           ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
           ->trace(true)
           ->classmap([
               Exchange::class
           ]);
        });
        $data = ['stocks' => $this->prepare_input_favorites($user)];

        $favorites = $soapWrapper->call('ExchangeList.GetStocks', [
            $data
        ]);

        $exchanges = $soapWrapper->call('ExchangeList.GetExchanges', [
            new Exchange()
        ]);
        $sectors = $soapWrapper->call('ExchangeList.GetListOfSectors', []);
        $fav = [];
        if((array) $favorites != null) {
            if (gettype($favorites->GetStocksResult->Stock) == 'object') {
                $fav = [$favorites->GetStocksResult->Stock];
            } else {
                $fav = $favorites->GetStocksResult->Stock;
            }
        }

        return view("exchange")
            ->with("exchanges", $exchanges->GetExchangesResult->Exchange)
            ->with("sectors", $sectors->GetListOfSectorsResult->string)
            ->with("user", $user)
            ->with("favorites", $fav);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for entering a price range.
     *
     * @return \Illuminate\Http\Response
     */
    public function zoek()
    {
        //return view("zoekLaptop");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /****** in klasse Merk *****
    public function verkoper() {
    return $this->belongsTo(
    'App\Models\Verkoper');
    }
     ****************/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function prepare_input_favorites($user){
        return implode(",", array_filter([
            $user->favorite_1,
            $user->favorite_2,
            $user->favorite_3,
            $user->favorite_4,
            $user->favorite_5
        ]));
    }
}


