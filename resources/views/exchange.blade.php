@extends('master')
@section('subtitle')
    Exchanges
@stop
@section('content')
    <div id="exchange_list">
        @foreach($exchanges as $e)
            @csrf
            <div id="exchange">
                <b>{{$e->Name}}</b>
                <br>
                <p>{{$e->Country}}</p>
                <button onclick="location.href='{{ url('/exchanges/' . $e->ShortName . '/stocks') }}'">View stocks</button>
            </div>
        @endforeach
    </div>
@stop
