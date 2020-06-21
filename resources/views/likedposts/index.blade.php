@extends('layouts.master')

@section('title', "ShareInspire Forum | Posts Liked By You")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header bg-secondary text-light text-center">
          <h4>
            Posts 
            <i class="fa fa-heart text-danger"></i>
            Liked By You
          </h4>
        </div>

        <div class="card-body">
          <ul>
            @forelse($likedPosts as $post)
              @include('layouts.postslistitem')
            @empty
              <li>No Posts Liked yet.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
