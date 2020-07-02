@extends('layouts.master')

@section('title', "ShareInspire Forum | {$user->name} | Profile")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg mb-3">
        <div class="card-body">
          @if ($profileImageUrl)
            <img class="profile-image" width="125" src="{{ $profileImageUrl }}">
          @else
            <i class="fa fa-5x fa-user text-secondary"></i>
          @endif

          <h3>
            {{ $user->name }}
            <small>
              Member since {{ $user->created_at->diffForHumans() }}
            </small>
          </h3>

          @can('update', $user)
            <a href="{{ route('profiles.edit', $user) }}"
              class="btn btn-sm btn-custom">
              Edit Profile
            </a>
          @endcan
        </div>
      </div>

      <div class="card shadow-lg mb-3">
        <div class="card-header">
          <h5>
            About {{ $user->name }}
          </h5>
        </div>
        <div class="card-body">
          <p>
            {{ $user->about }}
          </p>
        </div>
      </div>

      <div class="card shadow-lg mb-3">
        <div class="card-header">
          <h5>
            Topics created by {{ $user->name }}
          </h5>
        </div>
        <div class="card-body">
          <ul>
            @forelse($user->topics as $topic)
              <li>
                <a href="{{ route('posts.index', $topic) }}" class="text-custom">
                  {{ $topic->title }} 
                  @if (!$topic->approved)
                    <em>
                      (waiting for approval by website admin)
                    </em>
                  @endif
                </a>
                <em>
                  Created on {{ $topic->created_at->toDayDateTimeString() }}
                </em> 
              </li>
            @empty
              <li>No Topics Created yet.</li>
            @endforelse
          </ul>
        </div>
      </div>

      <div class="card shadow-lg mb-3">
        <div class="card-header">
          <h5>
            Posts created by {{ $user->name }}
          </h5>
        </div>
        <div class="card-body">
          <ul>
            @forelse($user->posts as $post)
              <li>
                <a href="{{ route('posts.index', $post->topic) }}" class="text-custom">
                  {{ substr($post->content, 0 ,80) }}....
                </a>
                <em>
                  Created on {{ $post->created_at->toDayDateTimeString() }}
                </em> 
              </li>
            @empty
              <li>No Posts Created yet.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
