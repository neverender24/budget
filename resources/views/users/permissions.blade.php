@extends('app')

@section('content')

    {!! Form::open(['url' => 'users/'.$user_id.'/permissions']) !!}
        @foreach($offices as $office)
            <label><input type="checkbox" name="funcs[]" value="{{ $office->refid }}"
            @foreach($permissions as $permission)
                @if( $permission->func_id == $office->refid )
                    checked
                @endif
            @endforeach
            /> {{ $office->FFUNCTION }}  ({{ $office->FFUNCCOD }})</label><br/>
        @endforeach

        {!! Form::submit('Save') !!}
    {!! Form::close() !!}

@endsection