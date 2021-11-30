@extends('master')
@section('subtitle')
    <h3 style="text-align: center">{{$exchange}}</h3>
@stop
@section('content')
    <script>
        window.onload = function () {
            fetch('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/history')
            .then(response => response.json())
            .then(data => {
                let graph_data = JSON.parse(data);
                let d = [];
                let labels = [];
                for(var i in graph_data) {
                    let str = graph_data[i]['Date'].toString();
                    d.push(graph_data[i]['Close']);
                    labels.push(str.replace('T00:00:00.000Z',''));
                }
                let ctx = document.getElementById('graphCanvas').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Price in dollar',
                            data: d,
                            borderColor: 'rgba(0,0,0,1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 10
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: "Stock price of {{$info[0]['longName']}}"
                        },
                    }
                });
                return JSON.parse(data);
            });
        };
    </script>
    <script>
        function showInfo() {
            document.getElementById("sub_info").style.display = "block"
            document.getElementById("sub_dividends").style.display = "none"
            document.getElementById("sub_financials").style.display = "none"
            document.getElementById("sub_institutional_holders").style.display = "none"
            document.getElementById("sub_recommendations").style.display = "none"
        }
        function showDividends() {
            document.getElementById("sub_info").style.display = "none"
            document.getElementById("sub_dividends").style.display = "block"
            document.getElementById("sub_financials").style.display = "none"
            document.getElementById("sub_institutional_holders").style.display = "none"
            document.getElementById("sub_recommendations").style.display = "none"
        }
        function showFinancials() {
            document.getElementById("sub_info").style.display = "none"
            document.getElementById("sub_dividends").style.display = "none"
            document.getElementById("sub_financials").style.display = "block"
            document.getElementById("sub_institutional_holders").style.display = "none"
            document.getElementById("sub_recommendations").style.display = "none"
        }
        function showHolders() {
            document.getElementById("sub_info").style.display = "none"
            document.getElementById("sub_dividends").style.display = "none"
            document.getElementById("sub_financials").style.display = "none"
            document.getElementById("sub_institutional_holders").style.display = "block"
            document.getElementById("sub_recommendations").style.display = "none"
        }
        function showRecommendations() {
            document.getElementById("sub_info").style.display = "none"
            document.getElementById("sub_dividends").style.display = "none"
            document.getElementById("sub_financials").style.display = "none"
            document.getElementById("sub_institutional_holders").style.display = "none"
            document.getElementById("sub_recommendations").style.display = "block"
        }
        window.addEventListener("load", function () {
            showInfo();
        });
    </script>
    <h1 style="text-align: center">{{$info[0]['longName']}}</h1>
    <hr>
    <div id="chart-container" style="width: 50%; float: left">
        <canvas id="graphCanvas"></canvas>
    </div>
    <div style="float: left; width: 48%;" >
        <div class="navbar">
            <div onclick="showInfo()">Info</div>
            <div onclick="showDividends()">Dividends</div>
            <div onclick="showFinancials()">Financials</div>
            <div onclick="showHolders()">Institutional Holders</div>
            <div onclick="showRecommendations()">Recommendations</div>
        </div>
        <div id="sub_info">
            @include('overviews.info')
        </div>
        <div id="sub_dividends">
            @include('overviews.dividends')
        </div>
        <div id="sub_financials">
            @include('overviews.financials')
        </div>
        <div id="sub_institutional_holders">
            @include('overviews.institutional_holders')
        </div>
        <div id="sub_recommendations">
            @include('overviews.recommendations')
        </div>
    </div>
@stop
