@extends('admin.layouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('banner')
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
@endsection

@section('content')

<section id="overview">
  <div class="row">
    <div class="col-md-12">
      @include('admin.dashboard._website-overview')
    </div>
  </div>
</section>

<section id="latest-info">
  <div class="row">
    <div class="col-md-6">
      @include('admin.dashboard._newly-created-topics')
    </div>
    <div class="col-md-6">
      @include('admin.dashboard._newly-registered-users')
    </div>
  </div>
</section>
@endsection
