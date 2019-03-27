@extends('app')

@section('header_styles')
    <style>
        td {word-wrap: break-word}
    </style>
@stop

@section('content')
    <h3><b>Office</b>: {{$funcCode}} - {{$funcName}}</h3>
    <h4 class="">Details for <b>{{ $raoh->FRAODESC }}</b></h4>

    <table class="table table-bordered table-hover" id="users-table">
        <thead>
        <tr>
            <th>Description</th>
            <th>Account Code</th>
            <th>Source of Funds</th>
            <th>Appropriations</th>
            <th>Allotments</th>
            <th>Obligations</th>
            <th>Approp Bal</th>
            <th>Unutilized</th>
            <th>Utilization Rate</th>
            <th>Unalloted Approp</th>
            <th>Unobligated Allot</th>
            <th>PR Amount</th>
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
    ajax: '{{ url('funcs/'.$funcCode.'/raohs/'.$raoh->FRAOCOD.'/raods/data/') }}',
    columns: [
        { data: 'FOOEDESC', name: 'FOOEDESC',"sWidth": "500px"  },
        { data: 'FACTCODE', name: 'FACTCODE' },
        { data: 'FSOURCOD', name: 'FSOURCOD' },
        { data: 'fapprop', name: 'fapprop',"sClass": "text-right" },
        { data: 'fallot', name: 'fallot',"sClass": "text-right" },
        { data: 'foblig', name: 'foblig' ,"sClass": "text-right"},
        { data: 'balance', name: 'balance', orderable: true, searchable: true,"sClass": "text-right"},
        { data: 'balance_percent', name: 'balance_percent', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance_percent2', name: 'balance_percent', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance2', orderable: true, searchable: true,"sClass": "text-right"},
        { data: 'balance3', orderable: true, searchable: true,"sClass": "text-right"},
        { data: 'PRAMOUNT', "sClass": "text-right"}
    ]

@stop