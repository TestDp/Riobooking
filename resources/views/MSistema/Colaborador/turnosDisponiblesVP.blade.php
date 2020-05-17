@section('content')
    @foreach($turnos as $turno)
    <li>
        <input type="radio" id="radio1" name="radio_time" value="{{$turno->Inicio}}">
        <label for="radio1">{{$turno->Inicio}}</label>
    </li>
    @endforeach
@endsection
