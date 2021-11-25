<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchange;
use App\Models\Stock;

class StockController extends Controller
{
    public function getStocksFromExchange($exchange) {
        $allStocks= Stock::all()
            ->where('exchange','==', $exchange);
        return view("stocks")->with("stocks",$allStocks)->with('exchange', $exchange);
    }

    public function info($stock) {
        return $stock;
    }
}
