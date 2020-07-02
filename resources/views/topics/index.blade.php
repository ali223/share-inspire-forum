@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

@section('breadcrumbs')
  <div class="row">
    <div class="col-md-12">
      @include('topics._breadcrumbs')
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-custom-secondary">
          <h4>
            Category: 
            <strong>{{ $category->name }}</strong>
          </h4>
        </div>

        <div class="card-body">
          <table class="table text-left">
            <thead>
              <tr>
                <th>Topic Title</th>
                <th>By</th>
                <th>Created At</th>
                <th>No. of Posts</th>
              </tr>
            </thead>

            <tbody>
              @foreach($category->topics as $topic)
                <tr>
                  <td>
                    <a href="{{ route('posts.index', $topic->id) }}" class="text-dark">
                      <strong>{{ $topic->title }}</strong>
                      <br>
                      @if (!$topic->approved)
                        <em>(Waiting for admin approval)</em>
                      @endif
                    </a>
                  </td>
                  <td>
                    <a href="{{ route('profiles.show', $topic->user->id) }}" class="text-dark">
                      {{ $topic->user->name }}
                    </a>
                  </td>
                  <td>
                    {{ $topic->created_at->toDayDateTimeString() }}
                  </td>
                  <td>
                    {{ $topic->posts->count() }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <hr>

          @auth
            <a href="{{ route('topics.create', $category->id) }}" class="btn btn-custom">
              Create a New Topic
            </a>
          @endauth
        </div>
      </div>
    </div>
  </div>
@endsection
