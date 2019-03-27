@extends('app')

@section('header','List of Accomplishments')

@section('content')

    <div class="panel panel-default">
    <div class="table-responsive">
        @include('pages.search',['url'=>'funcs','link'=>'funcs'])
            <table id="mytable1" class="table-striped table table-bordered table-hover">
                <thead>
                    <th>Code</th>
                    <th>Description</th>
                </thead>
                <tbody>
                @foreach($funcs as $func)
                    <tr>
                        <td><a href="{{ action('RaohsController@index',[trim($func->FFUNCCOD)]) }}">{{ trim($func->FFUNCCOD) }}</a></td>
                        <td>{{ trim($func->FFUNCTION) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! $funcs->setPath('')->render() !!}
@stop
