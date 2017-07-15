@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>ADMIN Dashboard</p>
  </div>
</div>

@include('adminlayouts.message')

<h3>You are logged in as ADMIN!</h3>

<hr>

<h4> 
	<a href="{{ route('admintopics.index') }}">
		{{ $unapprovedTopicsCount }} topics are waiting to be approved 
	</a>
	
</h4>
<h4> {{ $unapprovedPostsCount }} posts are waiting to be approved </h4>

@endsection
