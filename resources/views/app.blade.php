<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Panel</title>

        <!-- global CSS -->
        <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">

        <link rel="stylesheet" href="{{ asset('public/bower_components/datatables/media/css/dataTables.bootstrap.css') }}">
         <link rel="stylesheet" href="{{ asset('public/bower_components/select2/dist/css/select2.min.css') }}">
         <link rel="stylesheet" href="{{ asset('public/css/select2-bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('public/css/fixedHeader.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/responsive.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/buttons.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/fixedColumns.dataTables.min.css') }}">


        <link rel="stylesheet" href="{{ asset('public/bower_components/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">

        <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

        <!-- page CSS -->
        @yield('header_styles')
        <style>
            body{
                margin: 0px 10px 0px 10px;
            }
            .dtr-details > li > span{
                width: 150px;
            }
            .back{
                color: red;
            }
            @media screen and (max-width: 767px) {
                li.paginate_button.previous {
                    display: inline;
                }
             
                li.paginate_button.next {
                    display: inline;
                }
             
                li.paginate_button {
                    display: none;
                }
            }
        </style>

    </head>

    <body>
        <div id="wrapper">

        <div class="row">
            <div class="col-md-12">
               <nav class="navbar navbar-inverse testnav" style="margin-top:16px;">
                  <div class="container-fluid">
                  <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-header">
                          <a class="navbar-brand" href="javascript:void(0);">FUMS Admin Panel</a>
                        </div>
                   </div>
                   <div class="collapse navbar-collapse" id="navigationbar">           
                        <div>
                          <ul class="nav navbar-nav">
                            @if (Auth::guest() )
                              <li><a href="{{ url('/before_index') }}"><span class="fa fa-home"></span> Home</a></li>
                            @else
                              <li><a href="{{ url('/') }}"><span class="fa fa-home"></span> Home</a></li>
                            @endif
                          </ul>
                          <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guest())
                            <li><a href="{{ url('auth/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            @else
                            <li><a href="#" id="rate-us"><span class="fa fa-star"></span> Rate this App!</a></li>
                            <li><a href="{{ url('change-password') }}"><span class="fa fa-key"></span> Change Password</a></li>
                            <li><a href="{{ url('auth/logout') }}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                            @endif
                          </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')
        {{-- rate us --}}
        <div class="modal modal-rate-us fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Rate this App!</h4>
              </div>
              <div class="modal-body">
                <select id="rating" name="rating">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <textarea class="form-control" name="rate-c" placeholder="Leave comments and suggestions" rows="5"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn-rate" data-dismiss="modal">Rate Now!</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{-- end rate us --}}
        <div class="row">
            <div class="col-md-12">
                <footer class="footer">
                    <div class="container">
                        <p class="text-muted"> Powered by: ITCDD | <span class="glyphicon glyphicon-copyright-mark"></span> Copyright 2017</p>
                    </div>
                </footer>
            </div>
        </div>
        

        <script src="{{  asset('public/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{  asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <script src="{{  asset('public/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{  asset('public/bower_components/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>

        <script src="{{  asset('public/bower_components/select2/dist/js/select2.min.js') }}"></script>

        <script src="{{  asset('public/js/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{  asset('public/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{  asset('public/js/responsive.bootstrap.min.js') }}"></script>

        <script src="{{  asset('public/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{  asset('public/js/buttons.flash.min.js') }}"></script>
        <script src="{{  asset('public/js/jszip.min.js') }}"></script>
        <script src="{{  asset('public/js/pdfmake.min.js') }}"></script>
        <script src="{{  asset('public/js/vfs_fonts.js') }}"></script>
        <script src="{{  asset('public/js/buttons.html5.min.js') }}"></script>
        <script src="{{  asset('public/js/buttons.print.min.js') }}"></script>
        <script src="{{  asset('public/js/dataTables.fixedColumns.min.js') }}"></script>

        {{-- rate us --}}
        <script src="{{  asset('public/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
        <script type="text/javascript">
           $(function() {
              $('#rating').barrating({
                theme: 'fontawesome-stars'
              });
           });
        </script>
        {{-- end rate us --}}

        <script>
            $(function() {
                var table = $('#users-table').DataTable({
                    pagingType: "full_numbers",
                    //processing: true,
                   // serverSide: true,
                   responsive: true,
                   dom: 'Bfrtip',
                    buttons: [
                        {
                            text: 'Back',
                            className: 'back'
                        }, 'excel'
                    ],
                    @yield('datatable')
                });

                new $.fn.dataTable.FixedHeader( table );
            });

            $("#rate-us").on('click', function(){
                $('.modal-rate-us').modal('show');
            });
            
            $("#btn-rate").on('click', function(){

                var rate = $('#rating').val();

               $.ajax({
                    url: '{{ url('rate/data?rate=') }}'+rate,
                    dataType: 'json',
                    success: function (data) {
                    },
                    error: function (data) {
                    }
                });

            });


        </script>

        <!--page jQuery -->
        @yield('footer_scripts')

    </body>
</html>
