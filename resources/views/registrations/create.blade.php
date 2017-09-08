@extends('layouts.master')

@section('title', "ShareInspire Forum | User Registration")

@section('content')

<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3><strong>User Registration Form</strong></h3>
  </div>

  <hr>

  @include('layouts.errors')

  <div class="panel-body text-left">
    <form method="POST" action=" {{ route('registrations.store') }}" enctype="multipart/form-data">

      {{ csrf_field() }}

      <div class="form-group">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
      </div>      

      <div class="form-group">
        <label for="email">Your Email Address:</label>
        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
      </div>      

      <div class="form-group">
        <label for="password">Your Password:</label>
        <input type="password" id="password" name="password" class="form-control">
      </div>      

      <div class="form-group">
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
      </div>      

      <div class="form-group">
        <label for="about">About You:</label>
        <textarea id="about" name="about" rows="5" class="form-control">{{ old('about') }}</textarea>
      </div>      

      <div class="form-group">
        <label for="photofile">Upload Your Photo (only .jpg)</label>
        <input type="file" id="photofile" name="photofile" class="form-control">
      </div>

      <div class="form-group">
        <input type="submit" value="Register" class="btn btn-primary" class="form-control">
      </div>      

    </form>
  </div>
</div>

@endsection