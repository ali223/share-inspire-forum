@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          Admin Dashboard
        </h1>
      </div>
    </div>
  </div>
</header>

<section id="overview">
  <div class="container margin-top">
    <div class="row">
      <div class="col-md-12">
        @include('adminlayouts.message')

        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
            Website Overview
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3">
                <div class="well dash-box">
                  <h3>
                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    {{ $categoriesCount }} Categories
                  </h3>
                  <p>
                    <a href="{{ route('admincategories.index') }}">
                      Create / Edit / View Categories
                    </a>
                  </p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="well dash-box">
                  <h3>
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                    {{ $topicsCount }} Topics 
                  </h3>
                  <p>
                    <a href="{{ route('admintopics.index') }}">
                      {{ $unapprovedTopicsCount }} topics, pending approval
                    </a>
                  </p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="well dash-box">
                  <h3>
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    {{ $postsCount }} Posts
                  </h3>
                  <p> {{ $unapprovedPostsCount }} posts, pending approval</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="well dash-box">
                  <h3>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    {{ $usersCount }} Users 
                  </h3>
                  <p>Total users registered</p>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="latest-info">
  <div class="container margin-top">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">            
            <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
            Newly Created Topics (Last 5)

            <span class="pull-right">
              <a class="view-all-link" href="{{ route('admintopics.index') }}">
                View All
              </a>
            </span>
            
          </div>
          <table class="table table-striped">
            <tr>
              <th>Title</th>
              <th>Created By</th>
              <th>Created</th>
            </tr>
            @foreach ($latestTopics as $topic)
              <tr>
                <td>{{ str_limit($topic->title, 40) }}</td>
                <td>{{ $topic->user->name }}</td>
                <td>{{ $topic->created_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          </table>
        </div>        

      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Newly Registered Users (Last 5)

            <span class="pull-right">
              <a class="view-all-link" href="#">
                View All
              </a>
            </span>

          </div>
          <table class="table table-striped">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Registered</th>
            </tr>
            @foreach ($latestUsers as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          </table>
        </div>        
      </div>      
    </div>
  </div>
</section>


@endsection
