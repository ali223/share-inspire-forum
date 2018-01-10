@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="container margin-top">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @include('adminlayouts.message')
      @include('adminlayouts.errors')

      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Create a New Category</h3>

        </div>

        <div class="panel-body text-left">
          <form method="POST" action=" {{ route('admincategories.store') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label for="name">Category Name:</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="description">Category Description:</label>
              <textarea id="description" name="description" class="form-control" required>{{ old('description') }}</textarea>
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
