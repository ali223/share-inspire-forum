@extends('layouts.master')

@section('title', 'ShareInspire Forum | Latest Posts')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card mt-2 mb-4">
        <div class="card-header text-center bg-custom text-light">
          <h3>Latest Posts</h3>
        </div>

        <div class="card-body">
          <ul>
            @foreach ($latestPosts as $post)
              @include('layouts.postslistitem', $post)
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
