@section('content')
    @foreach($Colaboradores as $colaborador)
    <div class="col-md-4">
        <div class="box_list wow fadeIn">
            <figure>
                <a href=""><img src="{{ $colaborador->rutaImagen.$colaborador->ImagenColaborador}}" class="img-fluid" alt="">
                </a>
            </figure>
            <div style="text-align:center;" class="wrapper">

                <h3>{{$colaborador->Nombre}}</h3>
                <div class="pricing-switcher">
                    <p class="fieldset">
                        <input onchange="renderSectionDisponibilidadColaborador()" type="radio" name="duration-2" value="monthly" id="monthly-2" checked>
                        <label for="monthly-2"><i class="icon-cancel"></i></label>
                        <input onclick="mostrarFecha()" type="radio" name="duration-2" value="yearly" id="yearly-2">
                        <label for="yearly-2"><i class="icon-ok"></i></label>
                        <span class="switch"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection