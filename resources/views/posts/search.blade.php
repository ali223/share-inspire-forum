@extends('layouts.master')

@section('title', 'ShareInspire Forum | Search Results')

@section('content')

@include('layouts.message')

<div class="panel panel-default">
  <div class="panel-heading text-center"><h3>Search Results</h3></div>

  <div class="panel-body">
    <ul>
    @foreach ($searchedPosts as $post)
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
