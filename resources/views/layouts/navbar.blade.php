@php
  $route = Route::currentRouteName();
@endphp
  <div id="app">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('home') }}">ShareInspire</a>          
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{ $route == 'home' ? 'active' : ''}}">
              <a href="{{ route('home') }}">Home </a>
            </li>

            <li class="{{ $route == 'posts.latest' ? 'active' : ''}}">
              <a href="{{ route('posts.latest') }}">Latest Posts</a>
            </li>

            @auth
              <li class="{{ $route == 'chatmessages.index' ? 'active' : ''}}">
                <a href="{{ route('chatmessages.index') }}">Chat Room</a>
              </li>

            @endauth

            @guest
              <li class="{{ $route == 'registrations.create' ? 'active' : ''}}">
                <a href="{{ route('registrations.create') }}">Sign Up</a>
              </li>
              <li class="{{ $route == 'sessions.create' ? 'active' : ''}}">
                <a href="{{ route('sessions.create') }}">Login</a>
              </li>
            @endguest

          </ul>
          <form class="navbar-form navbar-left" action="{{ route('posts.search') }}">
            <div class="form-group">
              <input type="text" name="keywords" class="form-control" placeholder="Search Posts" value="{{ request('keywords')}}">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>

          @auth
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#">Welcome {{ Auth::user()->name }}</a></li>

              <notifications-list></notifications-list>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('profiles.show', auth()->id()) }}">Your Profile</a></li>
                  <li><a href="#">Settings</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ route('sessions.destroy') }}">Logout</a></li>
                </ul>
              </li>
            </ul>
          @endauth
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
