<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stock viewer</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- CHARTS MIS JS scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="grid-container">
        <div class="item1" onclick="to_home_page()">
            <h1>Stock viewer</h1>
            <h3>@yield('subtitle')</h3>
        </div>
        <div class="item2">
            <h2>Navigation menu</h2>
            @yield('input_filter')
            <h3>User stuff</h3>
            <hr>
            @yield('navigation')
        </div>
        <div class="item3">@yield('content')</div>
        <div class="item4">
            <h3>Latest tweets from Bloomberg</h3>
            @include('tweets')
        </div>
        <div class="item5">
            <h5>Stock viewer</h5>
        </div>
    </div>
</body>
</html>
