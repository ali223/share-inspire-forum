@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="page-header">
<h1>ADMIN Dashboard</h1>
</div>
	
</div>
@include('adminlayouts.message')


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3><strong>Approve/Disapprove Topics</strong></h3>

  </div>

  <div class="panel-body text-left">
    <table class="table table-striped table-hover text-left">
       <thead>
         <tr>
           <th>Topic Title</th>
           <th>Created By</th>
           <th>Category</th>
           <th>Date Created</th>
           <th>No. of Posts</th>           
           <th>Status</th>
           <th>Action</th>
         </tr>
       </thead>

       <tbody>
          @foreach($topics as $topic)
          <tr>
            <td>{{ $topic->title }}</td>
            <td>{{ $topic->user->name }}</td>
            <td>{{ $topic->category->name}}</td>
            <td>{{ $topic->created_at->toDayDateTimeString() }}</td>
            <td>{{ $topic->posts->count() }}</td>
            <td>{{ $topic->approved == 0 ? 'Not Approved' : 'Approved' }}</td>
            <td>
              @if ($topic->approved == 0) 
                <a href="{{ route('admintopics.approve', $topic) }}">
                  Approve
                </a>
              @else
                <a href="{{ route('admintopics.disapprove', $topic) }}"> 
                  Disapprove
                </a>
              @endif
            </td>
          </tr>
          @endforeach
       </tbody>
    </table>
  </div>
</div>

@endsection
