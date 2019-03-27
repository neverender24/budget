@extends('app')

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('public/bower_components/hover/css/hover-min.css') }}">
@stop

@section('menu_header','EXPENDITURES')

@section('content')
    <div class="row text-center">
    <div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-lg-3 col-md-6 hvr-bob">
            <a href="{{ url('before_index') }}">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-sort-numeric-asc fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div><h4>RAAO</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 hvr-bob">
            <a href="{{ url('before-chrt') }}">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-area-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div><h4>Charts</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        {{--<div class="col-lg-3 col-md-6 hvr-bob">--}}
            {{--<a href="{{ url('status-report') }}">--}}
                {{--<div class="panel panel-success">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-3">--}}
                                {{--<i class="fa fa-area-chart fa-5x"></i>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-9 text-right">--}}
                                {{--<div class="huge"></div>--}}
                                {{--<div><h4>Status</h4></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    </div>
    </div>

@endsection

