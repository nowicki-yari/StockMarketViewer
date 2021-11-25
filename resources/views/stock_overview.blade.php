@extends('master')
@section('subtitle')
    <h3 style="text-align: center">{{$exchange}}</h3>
@stop
@section('content')
    <h1 style="text-align: center">{{$info[0]['longName']}}</h1>
    <hr>
    <div style="float: right">
        <h3>Description:</h3><br><br>
        <p style="text-align: justify; width: 40%">{{$info[0]['longBusinessSummary']}}</p>
    </div>
@stop
