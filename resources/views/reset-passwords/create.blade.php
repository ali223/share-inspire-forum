@extends('layouts.master')

@section('title', "ShareInspire Forum | Reset Password")

@section('content')
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-2 mb-4">
        <div class="card-header text-center bg-secondary text-light">
          <h3>Reset Password</h3>
        </div>

        <div class="card-body">
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
              <input type="submit" value="Reset Password" class="btn btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
