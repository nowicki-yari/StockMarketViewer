@extends('master')
@section('content')
    <input type="text" id="myInput" onkeyup="filter_stocks()" placeholder="Search for names.." title="Type in a name">
    <div id="stock_list">
        <h1 style="text-align: center">Stocks from the {{$exchange}}</h1>
        @foreach($stocks as $s)
            <div id="stock">
                <b>{{$s->name}}</b>
                <br>
                <p>{{$s->symbol}}</p>
            </div>
        @endforeach
    </div>
@stop
