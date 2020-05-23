@section('content')
    @guest
        <li><a class="btn btn-link" href="{{ route('login') }}">Inicio de Sesión</a></li>
        <li><a class="btn btn-link" href="{{ route('register') }}">Registrarse</a></li>
    @else
        <!-- /row -->
        <form id="formSolicitarResevar">
        <input type="hidden" id="TurnoPorColaborador_id" name="TurnoPorColaborador_id" >
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea rows="5" id="Comentario1" name="Comentario1" class="form-control" style="height:80px;" placeholder="Mensaje adicional"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div style="position:relative;">
            <input type="button" class="btn_1 full-width" value="Reservar Cita" onclick="guardarReservaUsuario()">
        </div>
        </form>
    @endguest
@endsection
