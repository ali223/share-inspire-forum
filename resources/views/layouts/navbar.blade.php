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
          <a class="navbar-brand" href="#">ShareInspire</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Latest Posts</a></li>
            @if(!Auth::check())
              <li><a href="{{ route('registrations.create') }}">Sign Up</a></li>
              <li><a href="{{ route('sessions.create') }}">Login</a></li>
            @endif
          </ul>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search Posts">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
          </form>

          @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Welcome {{ Auth::user()->name }}</a></li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Your Profile</a></li>
                  <li><a href="#">Your Posts</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ route('sessions.destroy') }}">Logout</a></li>
                </ul>
              </li>
            </ul>
          @endif
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
