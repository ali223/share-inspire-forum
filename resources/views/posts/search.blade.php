@extends('layouts.master')

@section('title', 'ShareInspire Forum | Search Results')

@section('content')

@include('layouts.message')

<div class="panel panel-default">
  <div class="panel-heading text-center"><h3>Search Results</h3></div>

  <div class="panel-body">
    <ul>
    @foreach ($searchedPosts as $post)
      @include('layouts.postslistitem', $post)
    @endforeach
    </ul>
  </div>
</div>

@endsection
