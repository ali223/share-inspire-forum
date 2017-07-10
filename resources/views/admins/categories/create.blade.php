@extends('adminlayouts.master')

@section('title', 'ShareInspire Forum | ADMIN')

@section('content')

<div class="page-header">
<h1>ADMIN Dashboard</h1>
</div>
	
</div>
@include('adminlayouts.message')


<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h3><strong>Create a New Category</strong></h3>

  </div>

  <div class="panel-body text-left">
    <form method="POST" action=" {{ route('admincategories.store') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" class="form-control">
      </div>      
      <div class="form-group">
        <label for="description">Category Description:</label>
        <textarea id="description" name="description" class="form-control"></textarea>
      </div>      

      <div class="form-group">
        <input type="submit" value="Create" class="btn btn-primary" class="form-control">
      </div>      


    </form>
  </div>
</div>

@endsection
