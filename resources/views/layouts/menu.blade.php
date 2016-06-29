<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/')  }}">UPCS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li {!! $currentView == 'dashboard' ? 'class="active"' : '' !!}><a href="{{ route('dashboard') }}"><span class="glyphicon glyphicon-home text-info"></span> Dashboard</a></li>
                @if($authUser->role_id == 2)
                <li {!! $currentView == 'users' ? 'class="active"' : '' !!}><a href="{{ route('get.users') }}"><span class="glyphicon glyphicon-user text-info"></span> Users</a></li>
                @endif
                <li {!! $currentView == 'clearance' ? 'class="active"' : '' !!}><a href="{{ route('get.clearance') }}"><span class="glyphicon glyphicon-th text-info"></span> Clearance</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown {!! $currentView == 'change_password' ? 'active' : '' !!}">
                    <a href="javascript::void();" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user text-primary"></span> {{ $authUser->firstname . ' ' . $authUser->lastname }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('get.change_password') }}"><span class="glyphicon glyphicon-lock text-info"></span> Change Password</a></li>
                        <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-off text-info"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>