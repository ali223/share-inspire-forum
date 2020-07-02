@extends('admin.layouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-lg">
        <div class="card-header text-center">
          <h4>
            Topics Approve/Disapprove
          </h4>
        </div>
        <table class="table table-striped table-hover text-left">
          <thead>
            <tr>
              <th>Topic Title</th>
              <th>Created By</th>
              <th>Category</th>
              <th>Date Created</th>
              <th>Posts Count</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($topics as $topic)
              <tr>
                <td>
                  {{ $topic->title }}
                </td>
                <td>
                  {{ $topic->user->name }}
                </td>
                <td>
                  {{ $topic->category->name}}
                </td>
                <td>
                  {{ $topic->created_at->toDayDateTimeString() }}
                </td>
                <td>
                  {{ $topic->posts->count() }}
                </td>
                <td>
                  {{ $topic->approved == 0 ? 'Not Approved' : 'Approved' }}
                </td>
                <td>
                  @if ($topic->approved == 0) 
                    <a 
                      href="{{ route('admin.topics.approve', $topic) }}" 
                      class="btn btn-custom"
                    >
                      Approve
                    </a>
                  @else
                    <a 
                      href="{{ route('admin.topics.disapprove', $topic) }}" 
                      class="btn btn-danger"
                    >
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
@endsection
