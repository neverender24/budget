@extends('app')

@section('header','List of Accomplishments')

@section('content')

    {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('Fiscal Year') !!}
            {!! Form::text('fiscalyear',null,['class'=>'input form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Office') !!}
            {!! Form::text('office',null,['class'=>'input form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('') !!}
            {!! Form::select('funds',$funds,null,['class'=>'input form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('') !!}
            {!! Form::select('types',$types,null,['class'=>'input form-control']) !!}
        </div>

    {!! Form::close() !!}

    {{--<div class="panel panel-default">--}}
    {{--<div class="table-responsive">--}}
            {{--<table id="mytable1" class="table-striped table table-bordered table-hover">--}}
                {{--<thead>--}}
                    {{--<th>Code</th>--}}
                    {{--<th>Description</th>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($funcs as $func)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{ action('QueriesController@index',[trim($func->ffunccod)]) }}">{{ trim($func->ffunccod) }}</a></td>--}}
                        {{--<td>{{ trim($func->ffunction) }}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--{!! $funcs->setPath('')->render() !!}--}}
@stop
