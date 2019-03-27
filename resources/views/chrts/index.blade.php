@extends('app')

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('public/bower_components/datatables/media/css/dataTables.bootstrap.css') }}">
@stop

@section('content')

    <table class="table table-bordered table-hover" id="users-table">
        <thead>
        <tr>
            <th>Code</th>
            <th>Office</th>
            <th>RAOD</th>
            <th>OOE</th>
            <th>Approp</th>
            <th>Allot</th>
            <th>Oblig</th>
            <th>Balance</th>
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')
    <script src="{{  asset('public/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
@stop

@section('datatable')
    ajax: '{{ url('chrts/data?factcde='.$account_code ) }}',
    columns: [
        { data: 'FUNCCOD', name: 'FUNCCOD' },
        { data: 'FFUNCTION', name: 'FFUNCTION' },
        { data: 'FRAOCOD', name: 'FRAOCOD' },
        { data: 'fooedesc', name: 'fooedesc'  },
        { data: 'fapprop', name: 'fapprop', "sClass": "text-right" },
        { data: 'fallot', name: 'fallot', "sClass": "text-right" },
        { data: 'foblig', name: 'foblig', "sClass": "text-right" },
        { data: 'balance', name: 'balance', orderable: true, searchable: true, "sClass": "text-right"}
    ]
@stop