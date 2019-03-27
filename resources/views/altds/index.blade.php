@extends('app')

@section('header_styles')

    <style>
        td {word-wrap: break-word}
    </style>
@stop

@section('content')
    <h3><b>Office</b>: {{$funcCode}} - {{$funcName}}</h3>
    <h4 class="">Details for <b>{{ $raoh->FRAODESC }}</b></h4>
    <h4 class="">Details for <b>{{ $ooe->FOOEDESC }}</b></h4>

    <table class="table table-bordered table-hover" id="users-table">
        <thead>
        <tr>
            {{-- <th>Year</th> --}}
            <th>FACTCODE</th>   
            <th>Amount</th>
            <th>Date</th>
            <th>Remarks</th>
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')
<script>
    $(function() {
        $('.back').css('background-color','red');
        $('.back').on("click", function(){
            window.location.href = '{{ url('funcs/'.$funcCode.'/raohs/'.$raoh->FRAOCOD.'/raods/') }}';
        });
    });
</script>
@stop

@section('datatable')
    ajax: '{{ url('funcs/'.$funcCode.'/raohs/'.$raoh->FRAOCOD.'/raods/'.$fraod.'/altds/data/') }}',
    columns: [
        {{-- { data: 'tyear'}, --}}
        { data: 'FACTCODE'},
        { data: 'FAMOUNT'},
        { data: 'FDATE'},
        { data: 'FREMARKS'}
    ]

@stop