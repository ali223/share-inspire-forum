@extends('layouts.master')

@section('title', "ShareInspire Forum | Forgot Password")

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card shadow-lg">
        <div class="card-header text-center">
          <h3>Forgot Password</h3>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('forgot-passwords.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="email">Your Email Address:</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
              <input type="submit" value="Send Password Reset Link" class="btn btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
