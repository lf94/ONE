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
            {{ Form::open(array('route' => 'user.search', 'class'=>'nav navbar-nav navbar-form navbar-left', 'method'=>'GET')) }}
                {{ Form::text('person-name', '', array('class' => 'form-control', 'placeholder' => 'Search for people...')) }}
                {{ Form::submit('Search', array('class' => 'btn btn-secondary')) }}
            {{ Form::close() }}
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
                        <img class="img-rounded btn-img-navbar" src='/2503ict-assign2/public/uploads/users/{{{ Auth::user()->email }}}/{{{ Auth::user()->profile_image }}}' title='N/A' alt='N/A'/> {{{ Auth::user()->fullname }}}
                    </a>
                </li>
                <li>
                    <a class="" href="{{ URL::route('user.edit', Auth::user()->id) }}"><span class="glyphicon glyphicon-cog"></span></a>
                </li>
                <li>
                    <a href="{{ URL::route('user.friends', Auth::user()->id) }}"><span class="glyphicon glyphicon-user"></span></a>
                </li>
                <li class="hidden-xs divider-vertical"></li>
                <li><a href="{{ URL::route('user.logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>