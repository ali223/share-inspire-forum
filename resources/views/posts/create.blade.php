@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->name} | Posts")

@section('content')

<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h2>Category: <strong>{{ $topic->category->name }}</strong></h2>
    <h3>Topic: <strong>{{ $topic->title }}</strong></h3>    
    <h3><strong>Create a New Post</strong></h3>

  </div>

  @if(count($errors))
  <div class="alert alert-danger" id="error-alert" role="alert">
    <ul>
      @foreach($errors->all() as $error) 
        <li> {{ $error }} </li>
      @endforeach
    </ul>
  </div>
  @endif


  <div class="panel-body text-left">
    <form method="POST" action=" {{ route('posts.store', $topic->id) }}">

      {{ csrf_field() }}
      <div class="form-group">
        <label for="content">Post content:</label>
        <textarea id="content" name="content" rows="5" class="form-control"></textarea>
      </div>      

      <div class="form-group">
        <input type="submit" value="Create Post" class="btn btn-primary" class="form-control">
      </div>      

    </form>
  </div>
</div>

@endsection