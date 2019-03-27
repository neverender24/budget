<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="{{ Request::segment(1) === '/' ? 'active' : null }}">
                <a href="{{ url('/') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="{{ Request::segment(1) === 'funcs' ? 'active' : null }}">
                <a href="{{ url('funcs' )}}"><i class="fa fa-pencil-square fa-fw"></i> Offices</a>
            </li>
            <li class="{{ Request::segment(1) === 'queries' ? 'active' : null }}">
                <a href="{{ url('queries' )}}"><i class="fa fa-search fa-fw"></i> Queries</a>
            </li>
        </ul>
    </div>
</div>