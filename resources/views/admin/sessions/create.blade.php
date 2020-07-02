@extends('layouts.master')

@section('title', "ShareInspire Forum | ADMIN Login")

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card shadow-lg">
        <div class="card-header text-center">
          <h4>
            ADMIN Login Form
          </h4>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('admin.sessions.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="email">Your Email Address:</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
              <label for="password">Your Password:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
              <input type="submit" value="Login" class="btn btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
