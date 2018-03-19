@extends('layouts.master')

@section('title', 'ShareInspire Forum | Search Results')

@section('content')

@include('layouts.message')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Search Results</h3>
        </div>

        <div class="panel-body">
          <ul>
          @forelse ($searchedTopics as $topic)
            <strong>
              Topic
            </strong>
            <a href="{{ route('posts.index', $topic->id) }}" class="link-underline">
              {{$topic->title}}
            </a>  
          
            <strong>Created by</strong>
            <a href="{{ route('profiles.show', $topic->user->id) }}" class="link-underline">
              {{ $topic->user->name }}
            </a>
            {{ $topic->created_at->diffForHumans() }}
          @empty
            <h3 class="text-center">
              No matching topics found.
            </h3>
          @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
