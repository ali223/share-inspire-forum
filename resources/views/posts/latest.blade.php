@extends('layouts.master')

@section('title', 'ShareInspire Forum | Latest Posts')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Latest Posts
          </h4>
        </div>

        <div class="card-body">
          <ul>
            @foreach ($latestPosts as $post)
              @include('posts._posts-list-item')
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
