@extends('layouts.master')

@section('title', "ShareInspire Forum | User Registration")

@section('content')
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card shadow-lg mt-2 mb-4">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            User Registration Form
          </h4>
        </div>

        <div class="card-body">
          <form method="POST" action=" {{ route('registrations.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="name">Your Name:</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>      

            <div class="form-group">
              <label for="email">Your Email Address:</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>      

            <div class="form-group">
              <label for="password">Your Password:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>      

            <div class="form-group">
              <label for="password_confirmation">Confirm Password:</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>      

            <div class="form-group">
              <label for="about">About You:</label>
              <textarea id="about" name="about" rows="5" class="form-control" required>{{ old('about') }}</textarea>
            </div>      

            <div class="form-group">
              <label for="photofile">Upload Your Photo <em>(Optional)</em></label>
              <input type="file" id="photofile" name="photofile" class="form-control">
            </div>

            <div class="form-group">
              <input type="submit" value="Register" class="btn btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
