@extends('layouts.master')

@section('title', 'ShareInspire Forum | Latest Posts')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>

@include('layouts.message')

<div class="panel panel-default">
  <div class="panel-heading text-center"><h3>Latest Posts</h3></div>

  <div class="panel-body">
    <ul>
    @foreach ($latestPosts as $post)
      <li>
        <p>
          {{ $post->content }} 

          <strong>Posted by</strong>

          <a href="{{ route('profiles.show', $post->user->id) }}">
            {{ $post->user->name }}
          </a>

          under the 
          <strong>Topic</strong> 

          <a href="{{ route('posts.index', $post->topic->id) }}">
            {{$post->topic->title}}
          </a>  
        </p>
      </li>

    @endforeach
    </ul>
  </div>
</div>

@endsection
