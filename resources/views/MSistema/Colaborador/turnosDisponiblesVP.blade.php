@section('content')
    @foreach($turnos as $turno)
    <li>
        <input type="radio" id="turno{{$turno->id}}" name="turno" value="{{$turno->id}}" onclick="mostrarFormReserva(this,{{$turno->id}})">
        <label for="turno{{$turno->id}}">{{$turno->Inicio}}</label>
    </li>
    @endforeach
@endsection
