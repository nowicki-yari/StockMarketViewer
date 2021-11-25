@extends('master')
@section('subtitle')
    Exchanges
@stop
@section('content')
    <div id="exchange_list">
        @foreach($exchanges as $e)
            @csrf
            <div id="exchange">
                <b>{{$e->name}}</b>
                <br>
                <p>{{$e->country}}</p>
                <button onclick="location.href='{{ url('/exchanges/' . $e->short_name . '/stocks') }}'">View stocks</button>
            </div>
        @endforeach
    </div>
@stop
