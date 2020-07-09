<a name="list"></a>
@foreach ($categories->chunk(3) as $chunk)
  <div class="row">
    @foreach ($chunk as $category)
      <div class="col-md-4">
        @include('categories._category-card')
      </div>
    @endforeach
  </div>
@endforeach
