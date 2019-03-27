<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{url('/')}}">ADMIN</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
</ul>
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li><a href="{{ url('auth/login') }}">Login</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                {{--@if(Auth::user()->role == 'admin')--}}
                {{--<li><a href="{{ url('auth/register') }}"><i class="fa fa-btn fa-user-plus"></i> Register</a></li>--}}
                {{--@endif--}}
                <li><a href="{{ url('change-password') }}"><i class="fa fa-btn fa-user-plus"></i> Change Password</a></li>
                <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
            </ul>
        </li>
    @endif
</ul>

