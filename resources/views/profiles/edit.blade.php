@extends('layouts.master')

@section('title', "ShareInspire Forum | {$user->name} | Profile")

@section('content')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <div class="panel panel-info">
        <div class="panel-heading">
          <h4>Edit Your Profile</h4>
        </div>
        <div class="panel-body">
        
          @include('layouts.errors')
          @include('layouts.message')

          <form method="POST" action=" {{ route('profiles.update', $user) }}" enctype="multipart/form-data">

            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
              <label for="about">About You:</label>
              <textarea id="about" name="about" rows="5" class="form-control" required>{{ old('about', $user->about) }}</textarea>              
            </div>

            <div>
              @if ($profileImageUrl)
                <img class="profile-image" width="125" src="{{ $profileImageUrl }}">
              @else
                <span class="glyphicon glyphicon-user profile-icon"></span>
              @endif              
            </div>

            <div class="form-group">
              <label for="photofile">Upload New Profile Image<em>(Optional)</em></label>
              <input type="file" id="photofile" name="photofile" class="form-control">
            </div>

            <div class="form-group">
              <input type="submit" value="Save Changes" class="btn btn-primary" class="form-control">
            </div>
            
          </form>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection