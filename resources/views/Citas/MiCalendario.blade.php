@extends('layouts.principal')

@section('content')

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/calendar.css')}}" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Mi Calendario</h3></div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('js/jquery-3.1.1.js')}}"></script>
    <script src="{{asset('js/underscore-min.js')}}"></script>
    <script src="{{asset('js/calendar.js')}}"></script>

    <script type="text/javascript">
        var calendar = $("#calendar").calendar({
                tmpl_path: "/tmpls/",
                events_source: function () { return []; }
            });
    </script>
@endsection
