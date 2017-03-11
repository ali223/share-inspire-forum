@extends('layouts.master')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h1>ShareInspire</h1>
  </div>
  <div class="panel-body">
    <p>A forum to share and inspire.</p>
  </div>
</div>



<div class="panel panel-default">
  <div class="panel-heading text-center">Topics</div>

  <div class="panel-body text-center">
    <!-- Table -->
    <table class="table">
       <thead>
         <tr>
           <th>Title</th>
           <th>Created By</th>
           <th>Date Created</th>  
           <th>Posts</th>                    
           <th>Last Post</th>                    
         </tr>
       </thead>

       <tbody>
         
       </tbody>
    </table>
  </div>
</div>

@endsection