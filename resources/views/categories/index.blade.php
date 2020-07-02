@extends('layouts.master')

@section('title', 'ShareInspire Forum | Categories')

@section('showcase')
  @include('layouts._showcase')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          @include('categories._categories-list')
        </div>
      </div>
    </div>
  </div>
@endsection
