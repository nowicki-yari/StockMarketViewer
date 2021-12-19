<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustryController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->middleware('auth');
        $this->soapWrapper = $soapWrapper;
    }

    public function getIndustriesFromSector($sector) {
        //Gets session data if it exists
        [$user, $fav] = $this->retrieve_session_data();

        $soapWrapper = new SoapWrapper();
        $soapWrapper->add('IndustryListFromSector', function ($service) {
            $service
                ->wsdl('https://stockmarketviewer.azurewebsites.net/Exchanges.asmx?WSDL')
                ->trace(true)
                ->classmap([
                    Industry::class
                ]);
        });

        $data = ['sector' => $sector];
        $response = $soapWrapper->call('IndustryListFromSector.GetListOfIndustriesFromSector', [
            $data
        ]);

        return view("industries")
            ->with("industries",$response->GetListOfIndustriesFromSectorResult->string)
            ->with("sector", $sector)
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
