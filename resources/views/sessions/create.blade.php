@extends('layouts.master')

@section('title', "ShareInspire Forum | User Login")

@section('content')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3><strong>User Login Form</strong></h3>
        </div>
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
    </div>
  </div>
</div>
@endsection