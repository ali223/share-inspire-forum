@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

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
  <div class="panel-heading text-center">
    <h3>Category: <strong>{{ $category->name }}</strong></h3>
  </div>

  <div class="panel-body text-center">
    <!-- Table -->
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
            <td><a href="{{ route('posts.index', $topic->id) }}">{{ $topic->title }}</a></td>
            <td>
              <a href="{{ route('profiles.show', $topic->user->id) }}">
                {{ $topic->user->name }}
              </a>
            </td>
            <td>{{ $topic->created_at->toDayDateTimeString() }}</td>
            <td>{{ $topic->posts->count() }}</td>
          </tr>
          @endforeach
       </tbody>
    </table>
    <hr>
    @if(Auth::check())
      <a href="{{ route('topics.create', $category->id) }}" 
        class="btn btn-primary">Create a New Topic</a>
    @endif

    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Categories List</a>

  </div>
</div>

@endsection