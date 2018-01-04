@extends('layouts.master')

@section('title', 'ShareInspire Forum | Search Results')

@section('content')

@include('layouts.message')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center"><h3>Search Results</h3></div>

        <div class="panel-body">
          <ul>
          @forelse ($searchedPosts as $post)
            @include('layouts.postslistitem', $post)
          @empty      
            <h3 class="text-center">
              No matching posts found.
            </h3>
          @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
