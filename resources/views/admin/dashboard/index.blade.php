@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')
<header id="header" class="py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>
          <i class="fa fa-lg fa-dashboard"></i>
          Admin Dashboard
        </h2>
      </div>
    </div>
  </div>
</header>

<section id="overview">
  <div class="container margin-top">
    <div class="row">
      <div class="col-md-12">
        @include('adminlayouts.message')

        @include('admin.dashboard._website-overview')
      </div>
    </div>
  </div>
</section>

<section id="latest-info">
  <div class="container margin-top">
    <div class="row">
      <div class="col-md-6">
        @include('admin.dashboard._newly-created-topics')
      </div>
      <div class="col-md-6">
        @include('admin.dashboard._newly-registered-users')
      </div>      
    </div>
  </div>
</section>
@endsection
