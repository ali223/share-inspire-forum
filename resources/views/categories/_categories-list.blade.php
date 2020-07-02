<a name="list"></a>
@foreach ($categories->chunk(3) as $chunk)
  <div class="row">
    @foreach ($chunk as $category)
      <div class="col-md-4">
        <a href="{{ route('topics.index', $category->id) }}" class="category-link">
          @include('categories._category-card')
        </a>
      </div>
    @endforeach
  </div>
@endforeach
