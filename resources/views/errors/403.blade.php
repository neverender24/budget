@extends('app')

@section('content')
        <!-- content -->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="centering text-center error-container">
                <div class="text-center">
                    <h1 class="without-margin">Access denied</h1>
                    <h4 class="text-warning">You don't have permission to access this page</h4>
                </div>
                <div class="text-center">
                    <h3><small>Choose an option below</small></h3>
                </div>
                <hr>
                <ul class="pager">
                    <li><a href="javascript:history.go(-1)">&larr; Go Back</a></li>
                    <li><a href="{{ url('/') }}">Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection