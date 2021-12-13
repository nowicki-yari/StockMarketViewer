@extends('master')
@section('subtitle')
    Exchanges
@stop
@section('content')
    <div id="exchange_list">
        @foreach($exchanges as $e)
            @csrf
            <div id="exchange" class="exchange">
                <b>{{$e->Name}}</b>
                <br>
                <p>{{$e->ShortName}}</p>
                <button onclick="location.href='{{ url('/exchanges/' . $e->ShortName . '/stocks') }}'">View stocks</button>
            </div>
        @endforeach
    </div>
@stop

@section('navigation')
    <h3>Sectors</h3>
    <hr>
    @foreach($sectors as $s)
        <div class="sectors">
            <a href="{{url('/sector/' . $s . '/industries')}}">{{$s}}</a>
        </div>
    @endforeach
@stop
