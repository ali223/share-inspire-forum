@extends('layouts.master')

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
    <h3>Topics in the <strong>{{ ($topics->count()) ? $topics->first()->category->name : ''}}</strong> category</h3>
  </div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table text-left">
       <thead>
         <tr>
           <th>Topic Title</th>
           <th>Created By</th>
           <th>Date Created</th>
           <th>Posts</th>
           
         </tr>
       </thead>

       <tbody>
          @foreach($topics as $topic)
          <tr>
            <td><a href="#">{{ $topic->title }}</a></td>
            <td>{{ $topic->user->name }}</td>
            <td>{{ $topic->created_at }}</td>
            <td></td>
          </tr>
          @endforeach
       </tbody>
    </table>
  </div>
</div>

@endsection