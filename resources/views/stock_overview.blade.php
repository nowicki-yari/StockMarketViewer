@extends('master')
@section('subtitle')
    <h3 style="text-align: center">{{$exchange}}</h3>
@stop
@section('content')
    <script>
        window.onload = function () {
            $.getJSON('http://127.0.0.1:5000/stock/{{$info[0]['symbol'] }}/history/2020-09-04/2021-01-08', function(data) {
                let graph_data = JSON.parse(data);
                let d = [];
                let labels = [];
                for(var i in graph_data) {
                    let str = graph_data[i]['Date'].toString();
                    d.push(graph_data[i]['Close']);
                    labels.push(str.replace('T00:00:00.000Z',''));
                }
                console.log(d);
                console.log(labels)
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
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            xAxis: [{
                                type: 'time',
                                ticks: {
                                    autoSkip: true,
                                    maxTicksLimit: 5
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
    <h1 style="text-align: center">{{$info[0]['longName']}}</h1>
    <hr>
    <div id="chart-container" style="width: 50%; float: left">
        <canvas id="graphCanvas"></canvas>
    </div>
    <div style="float: left; width: 48%;" >
        <h3>Description:</h3>
        <p style="text-align: justify;">{{$info[0]['longBusinessSummary']}}</p>
    </div>
@stop
