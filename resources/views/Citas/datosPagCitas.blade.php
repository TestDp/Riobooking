<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaCitas">
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
    <tbody>
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