<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;

class ExchangeController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $exchanges = $soapWrapper->call('ExchangeList.GetExchanges', [
            new Exchange()
        ]);

        $sectors = $soapWrapper->call('ExchangeList.GetListOfSectors', []);
        $array = json_decode(json_encode($sectors), true);
        $numeric_indexed_array = array_values($array['GetListOfSectorsResult']);
        return view("exchange")
            ->with("exchanges", $exchanges->GetExchangesResult->Exchange)
            ->with("sectors", $sectors->GetListOfSectorsResult->string);
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
}
