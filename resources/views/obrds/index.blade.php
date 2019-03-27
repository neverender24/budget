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
            <th>Payee</th>
            {{-- <th>Year</th> --}}
            <th>No.</th>
            <th>Date</th>
            <th>Part</th>
            <th>Amount</th>
            <th>Voucher No.</th>
            <th>PO No.</th>
            <th>Check No.</th>
            <th>Advice No.</th>
            <th>Jev No.</th>
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
    ajax: '{{ url('funcs/'.$funcCode.'/raohs/'.$raoh->FRAOCOD.'/raods/'.$fraod.'/obrds/data/') }}',
    columns: [
        { data: 'fpayee' },
        {{-- { data: 'tyear'}, --}}
        { data: 'fobrno'},
        { data: 'fdate'},
        { data: 'fpart'},
        { data: 'famount' },
        { data: 'FVOUCHNO' },
        { data: 'FPONO' },
        { data: 'FCHKNO' },
        { data: 'FADVNO' },
        { data: 'FJEVNO' },
    ]

@stop