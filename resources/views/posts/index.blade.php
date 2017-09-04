@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')

<div class="alert alert-success" id="message-alert" role="alert"></div>

@if(Session::has('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ Session::get('message') }}</div>
@endif


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3>Category: <strong>{{ $topic->category->name }}</strong></h3>
    <h4>Topic: <strong>{{ $topic->title }}</strong></h4>
    @if(!empty($approvalMessage))
      <strong><em>{{$approvalMessage}}</em></strong>
    @endif
  </div>

  <div class="panel-body text-center">
    @foreach($topic->posts as $post)
    
      <div class="panel panel-info text-left">
        <div class="panel-heading">
          <strong>
          Posted By
            <a href="{{route('profiles.show', $post->user->id)}}">
                {{ $post->user->name }} 
            </a>
            on 
            {{ $post->created_at->toDayDateTimeString() }}
          </strong>
        </div>
        <div class="panel-body">

            <p>{{ $post->content }}</p>
            @can('update', $post)
              <div class="interaction">
                <a href="#" class="edit">Edit</a> |
                <a href="#" class="delete">Delete</a>
              </div>
            @endcan
              </td>
        </div>
      </div>
    @endforeach

    <new-post></new-post>
    
    @if(Auth::check())
      <a href="{{ route('posts.create', $topic->id) }}" class="btn btn-primary">Create a New Post</a>
    @endif

    <a href="{{ route('topics.index', $topic->category->id) }}" class="btn btn-primary">Back to Topics List</a>
  </div>
</div>

@endsection

