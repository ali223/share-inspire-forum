@extends('admin.layouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')
  <categories-list :initial-categories="{{ json_encode($categories) }}">
  </categories-list>

  <flash-message></flash-message>
@endsection
