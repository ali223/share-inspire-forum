@extends('layouts.master')

@section('title', "ShareInspire Forum | {$topic->category->name} | {$topic->title} | Posts")

@section('content')

@if(session('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ session('message') }}</div>
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

    <posts-list :topic-id="{{ $topic->id }}"></posts-list>
    
    <a href="{{ route('topics.index', $topic->category->id) }}" class="btn btn-primary">Back to Topics List</a>
  </div>
</div>

<flash-message></flash-message>

@endsection

