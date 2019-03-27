@extends('app')

@section('header_styles')

@stop

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')


    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.data') !!}',
                columns: [
                    { data: 'fapprop', name: 'fapprop' },
                    { data: 'fallot', name: 'fallot' },
                    { data: 'foblig', name: 'foblig' }
                ]
            });
        });
    </script>
@stop