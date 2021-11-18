@extends('master')
@section('content')
    <div id="exchange_list">
        <h1 style="text-align: center">Exchanges</h1>
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
