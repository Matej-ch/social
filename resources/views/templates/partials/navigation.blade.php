<nav class="navbar navbar-custom">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">FRIENDFACE</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FriendZone <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Timeline</a></li>
                        <li><a href="{{ route('friends.index') }}">Friends</a></li>
                        <li><a href="#">Commercials</a></li>
                    </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="{{route('search.results')}}">
                <div class="form-group">
                    <input type="text" class="form-control" name="query" placeholder="Find friends">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{route('profile.index',['username' => Auth::user()->username ])}}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                    <li><a href="#">Map</a></li>
                    <li><a href="{{route('profile.edit') }}">Update</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign out</a></li>
                @else
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                    @endif
            </ul>
        </div><!-- /.navbar-collapse -->
</nav>