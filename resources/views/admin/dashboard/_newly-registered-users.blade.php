<div class="card shadow-lg mt-2">
  <div class="card-header text-left">
    <i class="fa fa-lg fa-user"></i>
    Newly Registered Users (Last 5)

    <a class="view-all-link float-right" href="#">
      View All
    </a>
  </div>
  <table class="table table-striped">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Registered</th>
    </tr>
    @foreach ($latestUsers as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->diffForHumans() }}</td>
      </tr>
    @endforeach
  </table>
</div>
