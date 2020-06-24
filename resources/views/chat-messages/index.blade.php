@extends('layouts.master')

@section('title', "ShareInspire Forum | Chat Room")

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <chat-messages :initial-messages="{{ json_encode($chatMessages) }}"></chat-messages>
      <flash-message></flash-message>
    </div>
  </div>
@endsection
