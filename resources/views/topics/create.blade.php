@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

@section('content')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Category: <strong>{{ $category->name }}</strong></h3>
          <h3><strong>Create a New Topic</strong></h3>

        </div>

        <div class="panel-body text-left">
          <form method="POST" action=" {{ route('topics.store', $category->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="title">Topic Title:</label>
              <input type="text" id="title" name="title" class="form-control">
            </div>      
            <div class="form-group">
              <label for="content">Topic Post:</label>
              <textarea id="content" name="content" class="form-control"></textarea>
            </div>      

            <div class="form-group">
              <input type="submit" value="Create" class="btn btn-primary" class="form-control">
            </div>      
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection