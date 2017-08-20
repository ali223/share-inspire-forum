@extends('layouts.master')

@section('title', 'ShareInspire Forum | Categories')

@section('content')

@include('layouts.message')

<div class="panel panel-default">
  <div class="panel-heading text-center"><h3>Forum Categories</h3></div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table text-left">
       <thead>
         <tr>
           <th>Category Name</th>
           <th>Category Description</th>
           <th>Created By</th>
           <th>No. of Topics</th>
         </tr>
       </thead>

       <tbody>
          @foreach($categories as $category)
          <tr>
            <td><a href="{{ route('topics.index', $category->id) }}">{{ $category->name }}</a></td>
            <td>{{ $category->description }}</td>
            <td>
                {{ $category->admin->name }}
            </td>
            <td>{{ $category->topics_count }}</td>
          </tr>
          @endforeach
       </tbody>
    </table>
  </div>
</div>

@endsection
