<div>
    <table bgcolor="#f5f5f5">
        <tbody>
        <tr>
            <td bgcolor="#FFFFFF"><img src="https://riobooking.co/welcome/img/logo.png" />
                <div>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <p>&iexcl;Hola <strong>{{$infoReserva->NombreColaborador}}</strong>! Tienes una nueva solicitud de reserva. Aqu&iacute; est&aacute; la informaci&oacute;n:</p>
                                <ul>
                                    <li><strong>Cliente:</strong> {{$infoReserva->NombreCliente}}</li>
                                    <li><strong>Lugar:</strong> {{$infoReserva->NombreCompania}}</li>
                                    <li><strong>Fecha:</strong> {{$infoReserva->Fecha}}</li>
                                    <li><strong>Hora:</strong>  {{$infoReserva->Inicio}} - {{$infoReserva->Fin}}</li>
                                </ul>
                                <p>Cordialmente...</p>
                                <strong>Tus amigos de RioBooking</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>