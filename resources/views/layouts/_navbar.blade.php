@php
  $route = Route::currentRouteName();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
  <a class="navbar-brand" href="{{ route('home') }}">ShareInspire</a>

  <button 
    class="navbar-toggler" 
    type="button" 
    data-toggle="collapse" 
    data-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" 
    aria-expanded="false" 
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ $route == 'home' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fa fa-lg fa-home"></i>
          Home
        </a>
      </li>

      <li class="nav-item {{ $route == 'posts.latest' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('posts.latest') }}">
          <i class="fa fa-lg fa-book"></i>
          Latest Posts
        </a>
      </li>

      @auth
        <li class="nav-item {{ $route == 'chat-messages.index' ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('chat-messages.index') }}">
            <i class="fa fa-lg fa-comment"></i>
            Chat Room
          </a>
        </li>
      @endauth

      @guest
        <li class="nav-item {{ $route == 'registrations.create' ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('registrations.create') }}">
            <i class="fa fa-lg fa-user"></i>
            Sign Up
          </a>
        </li>
        <li class="nav-item {{ $route == 'sessions.create' ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('sessions.create') }}">
            <i class="fa fa-lg fa-sign-out"></i>
            Login
          </a>
        </li>
      @endguest

      <form class="form-inline ml-md-2 my-2 my-lg-0" action="{{ route('topics.search') }}">
        <div class="form-group">
          <search-box 
            initial-value="{{ request('keywords') }}"
            algolia-app-id="{{ config('scout.algolia.id') }}"
            algolia-search-api-key="{{ config('scout.algolia.search_api_key') }}">
          </search-box>
        </div>

        <button type="submit" class="btn btn-dark ml-sm-2 mr-sm-2 text-white">
          Search
        </button>

        <img id="algolia-logo" class="ml-sm-1" src="{{ asset("images/search-by-algolia.png") }}">
      </form>
    </ul>

    @auth
      <ul class="navbar-nav ml-auto">
        <notifications-list></notifications-list>

        <li class="nav-item dropdown active">
          <a 
            class="nav-link dropdown-toggle" 
            href="#" 
            id="navbarDropdown" 
            role="button" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false"
          >
            <i class="fa fa-lg fa-user"></i>
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('profiles.show', auth()->id()) }}">
              Your Profile
            </a>
            <a class="dropdown-item" href="{{ route('profiles.edit', auth()->id()) }}">
              Edit Profile
            </a>
            <a class="dropdown-item" href="{{ route('liked-posts.index') }}">
              Posts Liked By You
            </a>
            <div class="dropdown-divider"></div>
            <logout-link action-url="{{ route('sessions.destroy') }}" csrf-token="{{ csrf_token() }}">
            </logout-link>
          </div>
        </li>
      </ul>
    @endauth
  </div>
</nav>
