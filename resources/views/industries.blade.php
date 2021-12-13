@extends('master')
@section('subtitle')
    {{$sector}}
@stop
@section('content')
    <div id="exchange_list">
        @foreach($industries as $i)
            @csrf
            <div class="exchange">
                <a href="{{url("/sector/" . $sector . "/industries/" . $i . "/stocks")}}">{{$i}}</a>
                <br>
            </div>
        @endforeach
    </div>
@stop
