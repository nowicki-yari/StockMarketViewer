@extends('master')
@section('subtitle')
    <h3 style="text-align: center">{{$exchange}}</h3>
@stop
@section('content')
    <script>
        function load_graph(range) {
            let url = 'http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/history'
            if (range) {
                let min_date;
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();
                let today_string = yyyy + '-' + mm + '-' + dd;
                switch (range) {
                    case 1:
                        min_date = new Date();
                        min_date.setDate(today.getDate() - 7);
                        break;
                    case 2:
                        min_date = new Date();
                        min_date.setDate(today.getDate() - 14);
                        break;
                    case 3:
                        min_date = new Date();
                        min_date.setMonth(today.getMonth() - 1);
                        break;
                    case 4:
                        min_date = new Date();
                        min_date.setMonth(today.getMonth() - 3);
                        break;
                    case 5:
                        min_date = new Date();
                        min_date.setMonth(today.getMonth() - 6);
                        break;
                    case 6:
                        min_date = new Date();
                        min_date.setFullYear(today.getFullYear() - 1);
                        break;
                    case 7:
                        min_date = new Date();
                        min_date.setFullYear(today.getFullYear() - 3);
                        break;
                    case 8:
                        min_date = new Date();
                        min_date.setFullYear(today.getFullYear() - 50);
                        break;
                }
                console.log(min_date);
                dd = String(min_date.getDate()).padStart(2, '0');
                mm = String(min_date.getMonth() + 1).padStart(2, '0'); //January is 0!
                yyyy = min_date.getFullYear();
                min_date = yyyy + '-' + mm + '-' + dd;
                url = url + '/' + min_date + '/' + today_string
            }
            fetch(url)
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
        window.onload = function (){
            load_graph();
        }
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
        <div id="date_div">
            <button onclick="load_graph(1)" class="center">1 week</button>
            <button onclick="load_graph(2)" class="center">2 weeks</button>
            <button onclick="load_graph(3)" class="center">1 month</button>
            <button onclick="load_graph(4)" class="center">3 months</button>
            <button onclick="load_graph(5)" class="center">6 months</button>
            <button onclick="load_graph(6)" class="center">1 year</button>
            <button onclick="load_graph(7)" class="center">3 years</button>
            <button onclick="load_graph(8)" class="center">All</button>
        </div>
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
