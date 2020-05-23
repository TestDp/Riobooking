@section('content')
    <form>
        <div class="row add_bottom_45">
            <div class="col-lg-7">
                <div class="form-group">
                    <div id="calendar"></div>
                    <input type="hidden" id="my_hidden_input">
                    <ul class="legend">
                        <li><strong></strong>Disponible</li>
                        <li><strong></strong>No Disponible</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <h6 style="text-align: center;">Turnos disponibles</h6>
                <ul class="time_select version_2 add_top_20" id="turnosDisponibles">

                </ul>
            </div>
        </div>
    </form>
@endsection
