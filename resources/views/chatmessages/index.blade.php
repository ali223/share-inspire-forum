@extends('layouts.master')

@section('title', "ShareInspire Forum | Chat Room")

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h3>Chat Messages</h3>

      <chat-messages></chat-messages>
      <flash-message></flash-message>
    </div>
  </div>
@endsection
