<h4>{{$user->name}}</h4>
<hr>

@foreach($favorites as $s)
    @isset($s->Exchange)
        <a href="{{url('/exchanges/' . $s->Exchange . '/stocks/' . $s->Symbol . '/info')}}">{{$s->Name}}</a>
        <br>
    @endisset
@endforeach

