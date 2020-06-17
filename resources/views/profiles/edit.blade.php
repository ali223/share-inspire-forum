@extends('layouts.master')

@section('title', "ShareInspire Forum | {$user->name} | Profile")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card mb-3">
        <div class="card-header bg-secondary text-light">
          <h5>
            Edit Your Profile
          </h5>
        </div>

        <div class="card-body">
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
              <label for="photofile">
                Upload New Profile Image
                <em>(Optional)</em>
              </label>
              <input type="file" id="photofile" name="photofile" class="form-control">
            </div>

            <div class="form-group">
              <input type="submit" value="Save Changes" class="btn btn-custom">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
