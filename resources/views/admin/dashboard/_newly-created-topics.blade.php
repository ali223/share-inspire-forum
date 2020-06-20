<div class="card shadow-lg mt-2 mb-4">
  <div class="card-header text-left bg-secondary text-light">
    <i class="fa fa-lg fa-book"></i>
    Newly Created Topics (Last 5)

    <a class="view-all-link float-right" href="{{ route('admin.topics.index') }}">
      View All
    </a>
  </div>
  <table class="table table-striped">
    <tr>
      <th>Title</th>
      <th>Created By</th>
      <th>Created</th>
    </tr>
    @foreach ($latestTopics as $topic)
      <tr>
        <td>{{ $topic->title }}</td>
        <td>{{ $topic->user->name }}</td>
        <td>{{ $topic->created_at->diffForHumans() }}</td>
      </tr>
    @endforeach
  </table>
</div>
