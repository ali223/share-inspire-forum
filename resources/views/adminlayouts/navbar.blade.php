<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
  <a class="navbar-brand" href="{{ route('admin.dashboard.index') }}">
    ShareInspire
  </a>

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
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
          Admin Dashboard
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          Categories
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.topics.index') }}">
          Topics
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          Posts
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          Users
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
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
          {{ Auth::guard('admin')->user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">
            Your Profile
          </a>
          <a class="dropdown-item" href="#">
            Edit Profile
          </a>
          <div class="dropdown-divider"></div>
          <logout-link 
            action-url="{{ route('admin.sessions.destroy') }}" 
            csrf-token="{{ csrf_token() }}"
          >
          </logout-link>
        </div>
      </li>
    </ul>
  </div>
</nav>
