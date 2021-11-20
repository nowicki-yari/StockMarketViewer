<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stock viewer</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
</head>
<body>

<div class="grid-container">
    <div class="item1" onclick="to_home_page()">
        <h1>Stock viewer</h1>
        <h3>@yield('subtitle')</h3>
    </div>
    <div class="item2">
        <h2>Navigation menu</h2>
        <input type="text" id="myInput" onkeyup="filter_stocks()" placeholder="Search for names.." title="Type in a name">
    </div>
    <div class="item3">@yield('content')</div>
    <div class="item4">
        <h3>Right bar for something</h3>
    </div>
    <div class="item5">
        <h5>Stock viewer</h5>
    </div>
</div>
</body>
</html>
