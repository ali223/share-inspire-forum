@extends('layouts.master')

@section('title', 'ShareInspire Forum | Search Results')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Search Results
          </h4>
        </div>

        <div class="card-body">
          <ul>
          @forelse ($searchedTopics as $topic)
            <li>
              <p>
                <strong>Topic</strong>
                <a href="{{ route('posts.index', $topic->id) }}" class="link-underline text-custom">
                  {{$topic->title}}
                </a>
              
                <strong>Created by</strong>
                <a href="{{ route('profiles.show', $topic->user->id) }}" class="link-underline text-custom">
                  {{ $topic->user->name }}
                </a>
                {{ $topic->created_at->diffForHumans() }}
              </p>
            </li>
          @empty
            <h4 class="text-center">
              No matching topics found.
            </h4>
          @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
