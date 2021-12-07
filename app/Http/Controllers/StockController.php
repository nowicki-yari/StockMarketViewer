<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Exchange;
use App\Models\Stock;
use Artisaninweb\SoapWrapper\SoapWrapper;

class StockController extends Controller
{

    public function getStocksFromExchange($exchange) {
        $allStocks= Stock::all()
            ->where('exchange','==', $exchange);
        return view("stocks")->with("stocks",$allStocks)->with('exchange', $exchange);
    }

    public function getInfo($exchange, $stock) {
        $data = Http::get("http://127.0.0.1:5000/stock/" . $stock . "/info")->json();
        return view("stock_overview")->with('exchange', $exchange)->with('info', json_decode($data, true));
    }
}
