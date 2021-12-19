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
        $user = "";
        $fav = [];
        if (session()->has('favorites')) {
            $fav = session('favorites');
        }
        if (session()->has('user')) {
            $user = session('user');
        }

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
            ->with("sector", $sector)
            ->with("favorites", $fav)
            ->with("user", $user);
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
