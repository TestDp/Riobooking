@extends('layouts.principal')

@section('content')

    <link href="{{asset('js/Plugins/fullcalendar/core/main.css')}}" rel='stylesheet' />
    <link href="{{asset('js/Plugins/fullcalendar/daygrid/main.css')}}"  rel='stylesheet' />
    <link href="{{asset('js/Plugins/fullcalendar/list/main.css')}}" rel='stylesheet' />
    <link href="{{asset('js/Plugins/fullcalendar/timegrid/main.css')}}"  rel='stylesheet' />

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Mi Agenda</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="agenda"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src={{asset('js/Plugins/fullcalendar/core/main.js')}}></script>
    <script src={{asset('js/Plugins/fullcalendar/daygrid/main.js')}}></script>
    <script src={{asset('js/Plugins/fullcalendar/list/main.js')}}></script>
    <script src={{asset('js/Plugins/fullcalendar/timegrid/main.js')}}></script>
    <script src={{asset('js/Plugins/fullcalendar/interaction/main.js')}}></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
