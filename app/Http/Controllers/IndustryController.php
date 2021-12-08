<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function getIndustriesFromSector($sector) {
        $data = ['sector' => $sector];
        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('IndustryListFromSector', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Industry::class
                ]);
        });

        $response = $soapWrapper->call('IndustryListFromSector.GetListOfIndustriesFromSector', [
            $data
        ]);
        return view("industries")
            ->with("industries",$response->GetListOfIndustriesFromSectorResult->string)
            ->with("sector", $sector);
    }
}
