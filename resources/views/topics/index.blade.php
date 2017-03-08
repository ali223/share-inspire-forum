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
           <th>Posts</th>
           
         </tr>
       </thead>

       <tbody>
          @foreach($category->topics as $topic)
          <tr>
            <td><a href="/topics/{{ $topic->id }}/posts">{{ $topic->title }}</a></td>
            <td>{{ $topic->user->name }}</td>
            <td>{{ $topic->created_at }}</td>
            <td></td>
          </tr>
          @endforeach
       </tbody>
    </table>
    <hr>
    <a href="/categories/{{ $category->id }}/topics/create" class="btn btn-primary">Create a New Topic</a>
    <a href="/categories" class="btn btn-primary">Back to Categories List</a>

  </div>
</div>

@endsection