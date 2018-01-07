@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @include('adminlayouts.message')

      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Topics Approve/Disapprove</h3>
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
    </div>
  </div>
</div>
@endsection
