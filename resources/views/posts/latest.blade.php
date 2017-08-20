@extends('layouts.master')

@section('title', 'ShareInspire Forum | Latest Posts')

@section('content')

@include('layouts.message')

<div class="panel panel-default">
  <div class="panel-heading text-center"><h3>Latest Posts</h3></div>

  <div class="panel-body">
    <ul>
    @foreach ($latestPosts as $post)
      @include('layouts.postslistitem', $post)
    @endforeach
    </ul>
  </div>
</div>

@endsection
