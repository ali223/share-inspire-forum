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

<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @include('adminlayouts.message')

      <div class="row">
        <div class="col-md-4">
          <div class="well dash-box">
            <h3>
              <span class="glyphicon glyphicon-book"></span>
              Topics 
            </h3>
            <p>
              <a href="{{ route('admintopics.index') }}">
                {{ $unapprovedTopicsCount }} topics are waiting to be approved 
              </a>
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="well dash-box">
            <h3>
              <span class="glyphicon glyphicon-pencil"></span>
              Posts
            </h3>
            <p> {{ $unapprovedPostsCount }} posts are waiting to be approved </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="well dash-box">
            <h3>
              <span class="glyphicon glyphicon-user"></span>
              Users 
            </h3>
            <p>Total users registered</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
