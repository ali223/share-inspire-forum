@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3>Category: <strong>{{ $topic->category->name }}</strong></h3>
    <h4>Topic: <strong>{{ $topic->title }}</strong></h3>
  </div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table text-left">
       <thead>
         <tr>
           <th>Posts</th>
           <th>Created By</th>
           <th>Date Created</th>           
         </tr>
       </thead>

       <tbody>
          @foreach($topic->posts as $post)
          <tr>
            <td>{{ $post->content }}</a></td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->created_at }}</td>
            <td></td>
          </tr>
          @endforeach
       </tbody>
    </table>
    <hr>
    <a href="{{ route('topics.index', $topic->category->id) }}" class="btn btn-primary">Back to Topics List</a>
  </div>
</div>

@endsection