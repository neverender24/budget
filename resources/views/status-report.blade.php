@extends('app')

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('public/bower_components/datatables/media/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/bower_components/datatables/media/css/buttons.dataTables.css') }}">
    <style>
        td {word-wrap: break-word}
    </style>
@stop

@section('content')
    <table class="table table-bordered table-hover display nowrap" id="users-table" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ffundcod</th>
            <th>fapptype</th>
            <th>ffunccod</th>
            <th>falltcod</th>
            <th>fsourcod</th>
            <th>fraodesc</th>
            <th>fooedesc</th>
            <th>factcode</th>
            <th>tapprop</th>
            <th>tallot</th>
            <th>toblig</th>
            <th>appbalance</th>
            <th>allotbalance</th>
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')
    <script src="{{  asset('public/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/dataTables.buttons.js') }}"></script>

    <script src="{{  asset('public/bower_components/datatables/media/js/buttons.flash.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/jszip.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/pdfmake.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/vfs_fonts.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/buttons.html5.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/buttons.print.min.js') }}"></script>
    <script src="{{  asset('public/bower_components/datatables/media/js/buttons.colVis.min.js') }}"></script>
@stop

@section('datatable')
    scrollX: true,
    ajax: '{{ url('status-report/data') }}',
    dom: 'Bfrtip',
    buttons: [
    {
        extend: 'print',
        message: 'Municipality',
            exportOptions:
    {
                columns: ':visible'
            }
    },
    {
        extend: 'collection',
        text: 'Export',
        buttons: [
            'copy',
            'excel',
            'csv',
            'pdf'
        ]
    }
    ,
    'colvis'
    ],
    columnDefs: [
        {
            visible: false
        }
    ],
    columns: [
        { data: 'ffundcod'},
        { data: 'fapptype'},
        { data: 'ffunccod' },
        { data: 'falltcod'},
        { data: 'fsourcod' },
        { data: 'fraodesc' },
        { data: 'fooedesc' },
        { data: 'factcode' },
        { data: 'tapprop' },
        { data: 'tallot' },
        { data: 'toblig' },
        { data: 'appbalance' },
        { data: 'allotbalance' },
    ]

@stop