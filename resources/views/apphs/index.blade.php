@extends('app')

@section('header_styles')
    <style>
        td {word-wrap: break-word}
    </style>
@stop

@section('content')
    <h3><b>Office</b>: {{$funcCode}} - {{$funcName}}</h3>
    <h4 class="">Details for <b>{{ $raoh->FRAODESC }}</b></h4>

    <table class="table table-bordered table-hover display nowrap" id="users-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                {{-- <th>Year</th> --}}
                <th>Date</th>
                <th>Amount</th>
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
            window.location.href = '{{ url('funcs/'.$funcCode.'/raohs/') }}';
        });
    });
</script>
@stop

@section('datatable')
    scrollX: true,
    ajax: '{{ url('funcs/'.$funcCode.'/raohs/'.$raoh->FRAOCOD.'/apphs/data/') }}',
    columns: [
        {{-- { data: 'tyear' }, --}}
        { data: 'fdate' },
        { data: 'famount' },
        { data: 'fremarks' },

    ]
@stop