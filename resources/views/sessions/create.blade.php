@extends('layouts.master')

@section('title', "ShareInspire Forum | User Login")

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3><strong>User Login Form</strong></h3>
  </div>

  <hr>

  @include('layouts.errors')

  <div class="panel-body text-left">
    <form method="POST" action=" {{ route('sessions.store') }}" enctype="multipart/form-data">

      {{ csrf_field() }}

      <div class="form-group">
        <label for="email">Your Email Address:</label>
        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
      </div>      

      <div class="form-group">
        <label for="password">Your Password:</label>
        <input type="password" id="password" name="password" class="form-control">
      </div>      

      <div class="form-group">
        <input type="submit" value="Login" class="btn btn-primary" class="form-control">
      </div>      

    </form>
  </div>
</div>

@endsection