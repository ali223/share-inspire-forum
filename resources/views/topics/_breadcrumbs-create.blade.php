<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}#list" class="text-dark">
        Categories
      </a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('topics.index', $category) }}" class="text-dark">
        {{ $category->name }}
      </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      Create a New Topic
    </li>
  </ol>
</nav>
