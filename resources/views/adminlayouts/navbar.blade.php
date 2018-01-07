<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('admins.index') }}">
        ShareInspire        
      </a>      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ route('admins.index') }}">Admin Home <span class="sr-only">(current)</span></a></li>

          <li><a href="{{ route('admincategories.create') }}">Categories</a></li>

          <li><a href="{{ route('admintopics.index') }}">Topics</a></li>

          <li><a href="{{ route('sessions.create') }}">Posts</a></li>

          <li><a href="{{ route('admintopics.index') }}">Users</a></li>

      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search Posts">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>

      @if(Auth::guard('admin')->check())
        <ul class="nav navbar-nav navbar-right">
            <li class="active">
              <a href="#">Welcome 
                {{ Auth::guard('admin')->user()->name }}
              </a>
            </li>
          
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('profiles.show', auth()->id()) }}">Your Profile</a></li>
              <li><a href="#">Settings</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('adminsessions.destroy') }}">Logout</a></li>
            </ul>
          </li>
        </ul>
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
