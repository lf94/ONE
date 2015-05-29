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
                        {{ Form::open(array('route' => 'user.login', 'class'=>'navbar-form navbar-left', 'method'=>'post')) }}
                            <div class="form-group">
                                {{ Form::text('email', '', array('placeholder' => 'Enter your email', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                            </div>
                            <input type="submit" class="btn btn-primary" value="Login"/>
                            <a href="{{ URL::to('register') }}" class="btn btn-default ">Register</a>
                        {{ Form::close() }}
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