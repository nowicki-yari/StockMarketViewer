@extends('master')
@section('subtitle')
    <h3 style="text-align: center">Stocks from the {{$exchange}}</h3>
@stop
@section('content')
    <div id="stock_list">
        @foreach($stocks as $s)
            <div id="stock">
                <b>{{$s->name}}</b>
                <br>
                <p>{{$s->symbol}}</p>
                <button onclick="location.href='{{ url('/exchanges/' . $exchange . '/stocks/' . $s->symbol . '/info') }}'">View {{$s->name}}</button>
            </div>
        @endforeach
    </div>
@stop
