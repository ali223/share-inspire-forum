@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="container margin-top">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @include('adminlayouts.message')
      @include('adminlayouts.errors')

      <categories-list></categories-list>

      <flash-message></flash-message>

    </div>
  </div>
</div>

@endsection
