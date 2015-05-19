<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#one-nav-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand"><a href="{{ URL::asset('/') }}">ONE</a></span>
        </div>
        <div class="collapse navbar-collapse" id="one-nav-collapse">
            <form class="nav navbar-nav navbar-form navbar-left" action="{{ URL::route('user.search') }}" method="post">
                {{ Form::text('person-name', '', array('class' => 'form-control', 'placeholder' => 'Search for people...')) }}
                {{ Form::submit('Search', array('class' => 'btn btn-secondary')) }}
            </form>
            <ul class="nav navbar-nav navbar-right">
                @yield('nav-items')
                
                <li><a href="{{ URL::route('documents.show') }}">Overview</a></li>
                
                @if (!Auth::check())
                    <li>
                        <form class="navbar-form navbar-left" action="{{ URL::route('user.login') }}" method="post">
                            <div class="form-group">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email"/>
                            </div>
                            <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Login"/>
                        </form>
                    </li>
                @else
                <li>
                    <a class="" href="{{ URL::route('user.show', Auth::user()->id) }}">
                        <img class="btn-img-navbar img-rounded" src="{{{ Auth::user()->profile_image }}}"/>{{{ Auth::user()->fullname }}}
                    </a>
                </li>
                <li class="hidden-xs divider-vertical"></li>
                <li><a href="{{ URL::route('user.logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>