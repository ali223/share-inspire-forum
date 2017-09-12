@extends('layouts.master')

@section('title', "ShareInspire Forum | Chat Room")

@section('content')

@if(session('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ session('message') }}</div>
@endif

  <h3>Chat Messages</h3>
  
  <chat-messages></chat-messages>

<flash-message></flash-message>

@endsection

