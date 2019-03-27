@extends('app')

@section('header_styles')
   
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
        {!! Form::open(['url' => 'funcs/raohs','class'=>'form-horizontal']) !!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Year</label>
                <div class="col-md-1">
                    {!! Form::select('year',['2019'=>'2019'],null,['class'=>'form-control', 'id'=>'year', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Office</label>
                <div class="col-md-4">
                    {!! Form::select('permission',['0'=>''],null,['class'=>'form-control permission', 'id'=>'js-example-basic-single']) !!}
                </div>
                <div class="col-md-2">
                    <div class="checkbox">
                        <label><input type="checkbox" id="chk-all" name="all" value="1">All</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Type</label>
                <div class="col-md-3">
                    {!! Form::select('type',[
                        ''=>'',
                        '1'=>'Personnel Services',
                        '2'=>'MOOE',
                        '3'=>'Capital Outlay',
                        '4'=>'Programs',
                        '5'=>'Projects'
                        ],null,['class'=>'form-control','id'=>'raoh-type']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 col-md-offset-5 col-xs-6 col-xs-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span> Enter</button>
                    <a href="{{ url('expenditures') }}" class="btn btn-danger btn-sm"><span class="fa fa-arrow-left"></span> Back</a>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
@stop


@section('footer_scripts')
    

    <script type="text/javascript">

        // SELECT2 TRIGGER
        $(document).ready(function() {
            $( "#js-example-basic-single" ).select2({
                theme: "bootstrap"
            });
        });
        // END SELECT2

        // YEAR TRIGGER
        $('#year').on('change', function(e){
            var year = e.target.value;

            $.get('param?year=' + year, function(data) {
                $('.permission').empty();
                $.each(data, function(index,subCatObj){
                    $('.permission').append('<option value="'+subCatObj.FFUNCCOD+'">'+subCatObj.offices+'</option>');
                });
                $(".permission").prepend("<option value='0' selected='selected'></option>").val('');
            });

            $('.permission').select2({
                placeholder: "Please select"
            });
            
        });
        // END YEAR TRIGGER

        // check if @all is checked
        $('.form-horizontal').submit(function() {
            
            if(!$('#js-example-basic-single').val()){
                $("#chk-all").prop('checked', true);
            }

            if(document.getElementById('chk-all').checked) {
                $("#js-example-basic-single").val("0");
            }

        });

        //WHEN BACK IS PRESSED
        function explode(){
          $('#year').val('2017');
          $( "#year" ).trigger( "change" );
        }
        setTimeout(explode, 1);
    </script>
@endsection