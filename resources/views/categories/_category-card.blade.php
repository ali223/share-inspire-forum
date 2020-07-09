<div class="card category-card shadow-lg my-3">
  <div class="card-header bg-custom-secondary">
    <h4>{{ $category->name }}</h4>
  </div>
  <div class="card-body d-flex flex-column justify-content-between">
    <p>{{ $category->description }}</p>
    <a href="{{ route('topics.index', $category) }}" class="btn btn-block btn-custom">
      View Topics
    </a>
  </div>
</div>
