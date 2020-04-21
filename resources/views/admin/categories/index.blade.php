@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

	@include('adminlayouts.message')
	@include('adminlayouts.errors')

	<categories-list></categories-list>

  <flash-message></flash-message>

@endsection
