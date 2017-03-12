@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
              <label for="post-content">Edit the Post</label>
              <textarea class="form-control" name="post-content" id="post-content" rows="5"></textarea>
              
            </div>
            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>

<div class="alert alert-success" id="message-alert" role="alert"></div>

@if(Session::has('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ Session::get('message') }}</div>
@endif


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3>Category: <strong>{{ $topic->category->name }}</strong></h3>
    <h4>Topic: <strong>{{ $topic->title }}</strong></h3>
  </div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table text-left">
       <thead>
         <tr>
           <th>Posts</th>
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
                <div class="interaction">
                  <a href="#" class="edit">Edit</a> |
                  <a href="#" class="delete">Delete</a>
                </div>
              </div>
            </td>
            <td>{{ $post->user->name }} </td>
            <td>{{ $post->created_at }}</td>
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

