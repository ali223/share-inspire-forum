@extends('layouts.master')

@section('title', "ShareInspire Forum | {$category->name} | Topics")

@section('breadcrumbs')
  <div class="row">
    <div class="col-md-12">
      @include('topics._breadcrumbs-create')
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
          <h4>Create a New Topic</h4>
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
              <button type="submit" class="btn btn-custom">
                Create
              </button>
            </div>      
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
