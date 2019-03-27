@extends('app')

@section('header_styles')

@stop

@section('content')

    @if($funcCode != 0)
    <h3><b>Office</b>: {{$funcCode}} - {{$funcName}}</h3>
    <h4 class="">List of Accounts</h4>
    @else
    <h3 class="">All Accounts</h3>
    @endif


    <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" id="users-table">
        <thead>
        <tr>
            {{-- if all offices --}}
            @if($funcCode == 0)
                <th>Description</th>
                @if(\Session::get('type') == '5' )
                    <th>Source</th>
                    <th>Office</th>
                @else
                    <th>Office</th>
                    <th>Source</th>
                @endif
            @else
                <th>Description</th>
                <th>Source</th>
            @endif

            <th>Appropriations</th>
            <th>Allotments</th>
            <th>Obligations</th>
            <th>Approp Bal</th>
            <th>Unutilized</th>
            <th>Utilization Rate</th>
            <th>Unalloted Approp</th>
            <th>Unobligated Allot</th>
            <th>PR Amount</th>
            {{-- if type is project = 5 --}}
            @if(\Session::get('type') == '5') 
                <th>Date Completed</th>
                <th>Status</th>
                <th>Remarks</th>
            @endif
        </tr>
        </thead>
    </table>
@stop

@section('footer_scripts')
<script>
    $(function() {
        $('.back').css('background-color','red');
        $('.back').on("click", function(){
            window.location.href = "{{ url('before_index') }}";
        });
    });
</script>
@stop

@section('datatable')
    ajax: '{{ url('funcs/'.$funcCode.'/raohs/data/') }}',
    autoWidth: false,
    columns: [
    
                {{-- if all offices --}}
        @if($funcCode == 0)
            { data: 'fraodesc', name: 'fraodesc', "sWidth": "100px"  },
            @if(\Session::get('type') == '5' )
                { data: 'FSOURCOD', name: 'FSOURCOD' },
                { data: 'ffunccod', name: 'ffunccod', "sWidth": "50px"  },
            @else
                { data: 'ffunccod', name: 'ffunccod', "sWidth": "50px"  },
                { data: 'FSOURCOD', name: 'FSOURCOD' },
            @endif
        @else
            { data: 'fraodesc', name: 'fraodesc', "sWidth": "100px"  },
            { data: 'FSOURCOD', name: 'FSOURCOD' },
        @endif
        { data: 'fapprop', name: 'fapprop', "sClass": "text-right" },
        { data: 'fallot', name: 'fallot', "sClass": "text-right" },
        { data: 'foblig', name: 'foblig', "sClass": "text-right" },
        { data: 'balance', name: 'balance', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance_percent', name: 'balance_percent', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance_percent2', name: 'balance_percent', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance2', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'balance3', orderable: true, searchable: true, "sClass": "text-right"},
        { data: 'PRAMOUNT', "sClass": "text-right"},
        @if(\Session::get('type') == '5')
        { data: 'DateCompleted'},
        { data: 'ProjectStatus'},
        { data: 'ProjectRemarks'},
        @endif
    ],
    columnDefs: [
        { width: 200, targets: 0 }
    ],
    fixedColumns: true,
@stop