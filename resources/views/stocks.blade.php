@extends('master')
@section('subtitle')

@stop
@section('content')
    <div id="stock_list">
        @foreach($stocks as $s)
            <div id="stock">
                <b>{{$s->Name}}</b> | {{$s->Symbol}}
                <br>
                <p>{{$s->Sector}}</p>
                <br>
                <p>{{$s->Industry}}</p>
                <button onclick="location.href='{{ url('/exchanges/' . $s->Exchange . '/stocks/' . $s->Symbol . '/info') }}'">View {{$s->name}}</button>
            </div>
        @endforeach
    </div>
@stop
