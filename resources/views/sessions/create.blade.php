@extends('layouts.master')

@section('title', "ShareInspire Forum | User Login")

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card shadow-lg">
        <div class="card-header text-center">
          <h4>
            User Login Form
          </h4>
        </div>

        <div class="card-body">
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
              <button type="submit" class="btn btn-custom form-control">
                Login with Email and Password
              </button>
            </div>

            <div class="form-group">
              <a href="{{ route('social-logins.redirect-to-provider', 'github') }}" class="btn btn-custom form-control">
                Sign In with GitHub
                <img src="{{ asset('images/github-icon.png') }}" width="20">
              </a>              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
