@extends('layouts.master')

@section('title', 'ShareInspire Forum | Categories')

@section('showcase')
  @include('layouts.showcase')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <a name="list"></a>

      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3>Forum Categories</h3>
        </div>

        <div class="panel-body text-center">
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
                  <td>
                    <a href="{{ route('topics.index', $category->id) }}">
                      <strong>{{ $category->name }}</strong>
                    </a>
                  </td>
                  <td>
                    {{ $category->description }}
                  </td>
                  <td>
                      {{ $category->admin->name }}
                  </td>
                  <td>
                    {{ $category->topics_count }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
