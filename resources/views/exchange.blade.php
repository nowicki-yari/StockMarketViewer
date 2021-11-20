@extends('master')
@section('subtitle')
    Exchanges
@stop
@section('content')
    <div id="exchange_list">
        @foreach($exchanges as $e)
            @csrf
            <div id="exchange" onclick="div_exchange_click({{$e}})">
                <b>{{$e->name}}</b>
                <br>
                <p>{{$e->country}}</p>
            </div>
        @endforeach
    </div>
@stop
