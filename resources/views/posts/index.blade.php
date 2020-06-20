@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg mt-2 mb-4">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Category: 
            <strong>{{ $topic->category->name }}</strong>
          </h4>
          <h5>
            Topic: 
            <strong>{{ $topic->title }}</strong>
          </h5>
          @if (!empty($approvalMessage))
            <strong>
              <em>{{$approvalMessage}}</em>
            </strong>
          @endif
        </div>

        <div class="card-body">
          <posts-list :topic-id="{{ $topic->id }}">
          </posts-list>
          
          <a href="{{ route('topics.index', $topic->category->id) }}" class="btn btn-custom">
            Back to Topics List
          </a>
        </div>
      </div>
      <flash-message></flash-message>
    </div>
  </div>
@endsection
