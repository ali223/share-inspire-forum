@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<header id="header" class="py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>
          <i class="fa fa-lg fa-dashboard"></i>
          Admin Dashboard
        </h2>
      </div>
    </div>
  </div>
</header>

<section id="overview">
  <div class="container margin-top">
    <div class="row">
      <div class="col-md-12">
        @include('adminlayouts.message')

        <div class="card mt-2 mb-4">
          <div class="card-header text-left bg-secondary text-light">
            <i class="fa fa-lg fa-feed"></i>
            Website Overview
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <div class="card shadow bg-light">
                  <div class="card-body text-center py-4">
                    <h4 class="mt-2">
                      <i class="fa fa-lg fa-list"></i>
                      {{ $categoriesCount }} Categories
                    </h4>
                    <p>
                      <a href="{{ route('admin.categories.index') }}" class="text-custom">
                        Create / Edit / View
                      </a>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card shadow bg-light">
                  <div class="card-body text-center py-4">
                    <h4 class="mt-2">
                      <i class="fa fa-lg fa-book"></i>
                      {{ $topicsCount }} Topics 
                    </h4>
                    <p>
                      <a href="{{ route('admin.topics.index') }}" class="text-custom">
                        {{ $unapprovedTopicsCount }} topics, pending approval
                      </a>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card shadow bg-light">
                  <div class="card-body text-center py-4">
                    <h4 class="mt-2">
                      <i class="fa fa-lg fa-pencil"></i>
                      {{ $postsCount }} Posts
                    </h4>
                    <p>
                      {{ $unapprovedPostsCount }} posts, pending approval
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="card shadow bg-light">
                  <div class="card-body text-center py-4">
                    <h4 class="mt-2">
                      <i class="fa fa-lg fa-user"></i>
                      {{ $usersCount }} Users 
                    </h4>
                    <p>
                      Total users registered
                    </p>
                  </div>
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
        <div class="card mt-2 mb-4">
          <div class="card-header text-left bg-secondary text-light">
            <i class="fa fa-lg fa-book"></i>
            Newly Created Topics (Last 5)

            <a class="view-all-link float-right" href="{{ route('admin.topics.index') }}">
              View All
            </a>
          </div>
          <table class="table table-striped">
            <tr>
              <th>Title</th>
              <th>Created By</th>
              <th>Created</th>
            </tr>
            @foreach ($latestTopics as $topic)
              <tr>
                <td>{{ $topic->title }}</td>
                <td>{{ $topic->user->name }}</td>
                <td>{{ $topic->created_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          </table>
        </div>

      </div>
      <div class="col-md-6">
        <div class="card mt-2 mb-4">
          <div class="card-header text-left bg-secondary text-light">
            <i class="fa fa-lg fa-user"></i>
            Newly Registered Users (Last 5)

            <a class="view-all-link float-right" href="#">
              View All
            </a>
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
