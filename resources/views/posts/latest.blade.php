@extends('layouts.master')

@section('title', 'ShareInspire Forum | Latest Posts')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Latest Posts</h3>
        </div>

        <div class="panel-body">
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
