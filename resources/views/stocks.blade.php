@extends('master')
@section('subtitle')
    <h3 style="text-align: center">Stocks from the {{$exchange}}</h3>
@stop
@section('content')
    <div id="stock_list">
        @foreach($stocks as $s)
            <div id="stock" onclick="div_stock_click({{$s}})">
                <b>{{$s->name}}</b>
                <br>
                <p>{{$s->symbol}}</p>
            </div>
        @endforeach
    </div>
@stop
