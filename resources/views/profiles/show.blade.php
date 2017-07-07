@extends('layouts.master')

@section('title', "ShareInspire Forum | {$user->name} | Profile")

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>

<div class="page-header">
    <h2>{{ $user->name }} <small>Member since {{ $user->created_at->diffForHumans()  }}</small></h2>
</div>    

<div class="panel panel-info">
  <div class="panel-heading">
    <h4>Topics created by {{ $user->name }}</h4>
  </div>
  <div class="panel-body">
    
    <ul>
        @foreach($user->topics as $topic)
          <li>
              <a href="{{ route('posts.index', $topic) }}">
                {{ $topic->title }}
              </a>
              <em>
                Created on {{ $topic->created_at->toDayDateTimeString() }}
              </em> 
          </li>
          
        @endforeach
    </ul>
  </div>
</div>

<div class="panel panel-info">
  <div class="panel-heading">
    <h4>Posts created by {{ $user->name }}</h4>
  </div>
  <div class="panel-body">
    
    <ul>
        @foreach($user->posts as $post)
          <li>
              <a href="{{ route('posts.index', $post->topic) }}">
                {{ substr($post->content, 0 ,80) }}....
              </a>
              <em>Created on {{ $post->created_at->toDayDateTimeString() }}</em> 
          </li>
          
        @endforeach
    </ul>
  </div>
</div>



@endsection