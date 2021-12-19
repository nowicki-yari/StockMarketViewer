<h3>{{ Auth::user()->name }}</h3>
<hr>
<div style="text-align: left; margin-left: 6px">
    <p >Favorite stocks:</p>
    @foreach($favorites as $s)
        @isset($s->Exchange)
            <a href="{{url('/exchanges/' . $s->Exchange . '/stocks/' . $s->Symbol . '/info')}}">{{$s->Name}}</a>
            <br>
        @endisset
    @endforeach
</div>

