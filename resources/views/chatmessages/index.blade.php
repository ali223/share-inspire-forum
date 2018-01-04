@extends('layouts.master')

@section('title', "ShareInspire Forum | Chat Room")

@section('content')
<div class="container margin-top">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
			@if(session('message'))
			  <div class="alert alert-success" id="add-message-alert" role="alert">{{ session('message') }}</div>
			@endif

			<h3>Chat Messages</h3>
			  
			<chat-messages></chat-messages>

			<flash-message></flash-message>
		</div>
	</div>
</div>
@endsection

