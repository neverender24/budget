@extends('app')

@section('header_styles')

@stop

@section('content')

    <table class="table table-bordered table-hover" id="users-table">
        <thead>
        <tr>
            <th>Office</th>
            <th>Role</th>
            <th>Name</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')
    
@stop

@section('datatable')
    ajax: '{{ url('users/data/') }}',
     "order": [[ 3, "desc" ]],
    columns: [
        { data: 'func_id' },
        { data: 'role' },
        { data: 'name'},
        { data: 'created_at'},
        { data: 'action'},
    ]
@stop