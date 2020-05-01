@extends('layouts.principal')

@section('content')

    <div class="container">
             <div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(66, 79, 99); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; display: block; opacity: 0;"><div style="position: relative; top: 34px; float: right; width: 6px; height: 116px; background-color: rgb(242, 179, 63); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div> 
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                <div class="panel-heading"><h3>Citas</h3></div>
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-md-3">
                          <label>Tipo Cita</label>
                                <select id="Tipo_Cita_id" name="Tipo_Cita_id"  class="form-control"  name="language">
                                    <option value="">Seleccionar</option>
                                    @foreach($listTiposCitas as $tipoCita)
                                        <option value="{{$tipoCita->Nombre}}">{{$tipoCita->Nombre}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-3">
                            Fecha
                            <input type="date" id="fecha" class='form-control'/>
                        </div>
                        <div class="col-md-3">
                             <label>Regional</label>
                                <select id="Regional_id" name="Regional_id"  class="form-control"  name="language" onchange="CargarTiposCitasPorRegional()">
                                    <option value="">Seleccionar</option>
                                    @foreach($listRegionales as $regional)
                                        <option value="{{$regional->Nombre}}">{{$regional->Nombre}}</option>
                                    @endforeach

                                </select>
               
                        </div>
                        <div class="col-md-3">
                            <input type="button" onclick="BuscadorCitas()" class='btn btn-success' value="Buscar"/>
                        </div>
                    </div>
                    <br/>
                    <div class="row" id='tablaCitasCompleta'>
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered">
                        <thead>
                        <tr>
                        
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo cita</th>
                            <th scope="col">Regional</th>
                            <th scope="col">Cupos por Cita</th>
                            <th scope="col">Cupos disponibles</th>
                            <th scope="col">Lugar Cita</th>
                            <th scope="col">    </th>
                        </tr>
                        </thead>
                        <tbody id="tablaCitas">
                        @foreach($listCitas as $Cita)
                            <tr>
                           
                                <td scope="row">{{$Cita->Fecha}}</td>
                                <td>{{$Cita->Inicio}}</td>
                                <td>{{$Cita->Fin}}</td>
                                <td>{{$Cita->NombreCita}}</td>
                                <td>{{$Cita->NombreRegional}}</td>
                                <td>{{$Cita->CuposJornada}}</td>
                                <td>{{$Cita->Cupos}}</td>
                                <td>{{$Cita->Lugar}}</td>
                                <td> <button onclick="GuardarReserva({{$Cita->id}})" type="button" class="btn btn-success">Reservar</button></td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                   {!!$listCitas->links()!!}
                </div>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">

       $(document).ready(function() {
          $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();

               $('#tablaCitasCompleta a').css('color', '#dfecf6');
                  $('#tablaPedidosCompleta').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="../images/loader.gif" />');

               var url = $(this).attr('href');
               getArticles(url);
               window.history.pushState("", "", url);
            });

            function getArticles(url) {
              $.ajax({
                   url : url
                }).done(function (data) {
                   $('#tablaCitasCompleta').html(data);
                }).fail(function () {
                   alert('Articles could not be loaded.');
                });
            }
        });
    </script>


@endsection
