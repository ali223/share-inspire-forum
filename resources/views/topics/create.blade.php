@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg mt-2 mb-4">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Category: 
            <strong>{{ $category->name }}</strong>
          </h4>
          <h4>
            <strong>Create a New Topic</strong>
          </h4>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('topics.store', $category->id) }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="title">Topic Title:</label>
              <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="content">Topic Post:</label>
              <textarea id="content" name="content" class="form-control" required></textarea>
            </div>      

            <div class="form-group">
              <input type="submit" value="Create" class="btn btn-custom">
            </div>      
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
