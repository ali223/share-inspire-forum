@extends('layouts.master')

@section('title', "ShareInspire Forum | User Login")

@section('content')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Reset Password</h3>
        </div>

        @include('layouts.errors')

        <div class="panel-body text-left">
          <form method="POST" action="{{ route('reset-passwords.store') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
              <p>
                <strong>Your Email Address:</strong> 
                {{ $email }}
              </p>
            </div>

            <div class="form-group">
              <label for="password">New Password:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm New Password:</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <div class="form-group">
              <input type="submit" value="Reset Password" class="btn btn-primary" class="form-control">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
