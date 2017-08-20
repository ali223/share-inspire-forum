@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')

@include('layouts.editpostmodal')

<div class="alert alert-success" id="message-alert" role="alert"></div>

@if(Session::has('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ Session::get('message') }}</div>
@endif


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3>Category: <strong>{{ $topic->category->name }}</strong></h3>
    <h4>Topic: <strong>{{ $topic->title }}</strong></h4>
    @if(!empty($approvalMessage))
      <strong><em>{{$approvalMessage}}</em></strong>
    @endif
  </div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table text-left">
       <thead>
         <tr>
           <th width="75%">Posts</th>
           <th>Created By</th>
           <th>Date Created</th>           
         </tr>
       </thead>

       <tbody>
          @foreach($topic->posts as $post)
          <tr>
            <td>
              <div class="content" data-postid="{{ $post->id }}">
                <p>{{ $post->content }}</p>
                @can('update', $post)
                  <div class="interaction">
                    <a href="#" class="edit">Edit</a> |
                    <a href="#" class="delete">Delete</a>
                  </div>
                @endcan
              </div>
            </td>
            <td>
              <a href="{{ route('profiles.show', $post->user->id) }}">
                {{ $post->user->name }} 
              </a>
            </td>
            <td>{{ $post->created_at->toDayDateTimeString() }}</td>
            <td></td>
          </tr>
          @endforeach
       </tbody>
    </table>
    <hr>
    @if(Auth::check())
      <a href="{{ route('posts.create', $topic->id) }}" class="btn btn-primary">Create a New Post</a>
    @endif

    <a href="{{ route('topics.index', $topic->category->id) }}" class="btn btn-primary">Back to Topics List</a>
  </div>
</div>

@endsection

@section('scripts')

<script>
  var token = "{{ csrf_token() }}";
  var urlEdit = "/topics/{{$topic->id}}/posts/";
  var urlDelete = "/topics/{{$topic->id}}/posts/";

</script>

<script src="{{ asset('js/myapp.js') }}"> </script>

@endsection

