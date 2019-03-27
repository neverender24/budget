@extends('app')

@section('content')

    {!! Form::open(['url' => 'users/'.$user_id.'/raohs/create']) !!}
        @foreach($data as $office)
            <label><input type="checkbox" name="raohs[]" value="{{ $office->refid }}"
   {{--          {{ dd( unserialize($office->raoh_id)) }} --}}
            @foreach($permissions as $permission) 
                <?php
                    if($permission->raoh_id == false){
                        $val = array();
                    }else{
                       $val = unserialize($permission->raoh_id);
                    }
                ?>
                @if(in_array($office->refid,$val))
                    checked
                @endif
            @endforeach
            />{{ $office->FFUNCCOD }} {{ $office->FRAODESC }}  ({{ $office->tyear }})</label><br/>
        @endforeach

        {!! Form::submit('SAVE') !!}
    {!! Form::close() !!}

@endsection