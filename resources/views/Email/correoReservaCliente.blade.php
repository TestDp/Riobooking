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
                                <p>&iexcl;Hola <strong>{{$infoReserva->NombreCliente}}</strong>!</p>

                                <p>Tu reserva ha sido enviada exitosamente. Aqu&iacute; est&aacute; la informaci&oacute;n:</p>
                                <ul>
                                    <li><strong>Lugar:</strong> {{$infoReserva->NombreCompania}}</li>
                                    <li><strong>Fecha:</strong> {{$infoReserva->Fecha}}</li>
                                    <li><strong>Hora:</strong>  {{$infoReserva->Inicio}} - {{$infoReserva->Fin}}</li>
                                    <li><strong>Profesional:</strong> {{$infoReserva->NombreColaborador}}</li>
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