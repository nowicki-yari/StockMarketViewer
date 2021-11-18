<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Stock viewer @yield('subtitle')</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
</head>
<body>
<div class="header">
    <h1 style="text-align: center" onclick="to_home_page()">Stock viewer</h1>
</div>

<section>
    <div id="side_nav">
        This is the user menu
    </div>
    <div id="content">
        @yield('content')
    </div>

</section>

<footer id="footer">
    <p>Footer</p>
</footer>
</body>
</html>
