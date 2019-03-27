@extends('app')

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('public/bower_components/hover/css/hover-min.css') }}">
@stop

@section('menu_header','DATA WAREHOUSE')

@section('content')
    <div class="row text-center">
    <div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-lg-3 col-md-6 hvr-bob">
            <a href="{{ url('expenditures') }}">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div><h4>Expenditures</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @if(Auth::user()->id == 1)
        <div class="col-lg-3 col-md-6 hvr-bob">
            <a href="{{ url('users') }}">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div><h4>Users</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 hvr-bob">
            <a href="{{ url('auth/register') }}">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div><h4>Register Users</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @endif
    </div>
    </div>

@stop

@section('footer_scripts')
    <script src="{{  asset('public/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
@stop
