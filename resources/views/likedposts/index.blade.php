@extends('layouts.master')

@section('title', "ShareInspire Forum | Posts Liked By You")

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>
            Posts 
            <span class="glyphicon glyphicon-heart"></span>
            Liked By You
          </h3>
        </div>

        <div class="panel-body">          
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
