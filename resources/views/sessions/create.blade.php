@extends('layouts.master')

@section('title', "ShareInspire Forum | User Login")

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>User Login Form</h3>
        </div>

        <div class="panel-body text-left">
          <form method="POST" action="{{ route('sessions.store') }}">
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
              <a href="{{ route('forgot-passwords.create') }}">
                Forgot your password?
              </a>
            </div>

            <div class="form-group">
              <input type="submit" value="Login" class="btn btn-primary" class="form-control">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
