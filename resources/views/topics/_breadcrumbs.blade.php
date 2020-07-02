<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}#list" class="text-dark">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      {{ $category->name }}
    </li>
  </ol>
</nav>
