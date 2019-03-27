@extends('app')

@section('header_styles')

@endsection

@section('content')
        {!! Form::open(['method'=>'GET','url' => 'chrts']) !!}
        <div class="row text-center">
            <div class="col-lg-12">
            <div class="form-group col-lg-6 col-lg-offset-3">
                <h3 class="title text-primary">Select Account Code</h3>
                {!! Form::select('factcde',$chrts,null,['class'=>'input form-control', 'id'=>'js-example-basic-single']) !!}
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="form-group col-lg-6 col-lg-offset-3">
                    <h3 class="title text-primary">Select Year</h3>
                    {!! Form::select('year',['2017'=>'2017'],null,['class'=>'input form-control', 'id'=>'js-example-basic-single']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Go!',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
        </div>
@stop

@section('footer_scripts')
  

    <script type="text/javascript">
        $(document).ready(function() {
            $("#js-example-basic-single").select2();
        });
    </script>
@endsection