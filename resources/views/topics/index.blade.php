@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-secondary text-light">
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
                <th>Created By</th>
                <th>Date Created</th>
                <th>No. of Posts</th>
              </tr>
            </thead>

            <tbody>
              @foreach($category->topics as $topic)
                <tr>
                  <td>
                    <a href="{{ route('posts.index', $topic->id) }}" class="text-custom">
                      <strong>{{ $topic->title }}</strong>
                      <br>
                      @if (!$topic->approved)
                        <em>(Waiting for admin approval)</em>
                      @endif
                    </a>
                  </td>
                  <td>
                    <a href="{{ route('profiles.show', $topic->user->id) }}" class="text-custom">
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

          @if (Auth::check())
            <a href="{{ route('topics.create', $category->id) }}" class="btn btn-custom">
              Create a New Topic
            </a>
          @endif

          <a href="{{ route('categories.index') }}#list" class="btn btn-custom">
            Back to Categories List
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
