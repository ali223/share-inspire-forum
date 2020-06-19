<div class="card mt-2 mb-4">
  <div class="card-header text-left bg-secondary text-light">
    <i class="fa fa-lg fa-feed"></i>
    Website Overview
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <div class="card shadow bg-light">
          <div class="card-body text-center py-4">
            <h4 class="mt-2">
              <i class="fa fa-lg fa-list"></i>
              {{ $categoriesCount }} Categories
            </h4>
            <p>
              <a href="{{ route('admin.categories.index') }}" class="text-custom">
                Create / Edit / View
              </a>
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow bg-light">
          <div class="card-body text-center py-4">
            <h4 class="mt-2">
              <i class="fa fa-lg fa-book"></i>
              {{ $topicsCount }} Topics 
            </h4>
            <p>
              <a href="{{ route('admin.topics.index') }}" class="text-custom">
                {{ $unapprovedTopicsCount }} topics, pending approval
              </a>
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow bg-light">
          <div class="card-body text-center py-4">
            <h4 class="mt-2">
              <i class="fa fa-lg fa-pencil"></i>
              {{ $postsCount }} Posts
            </h4>
            <p>
              {{ $unapprovedPostsCount }} posts, pending approval
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card shadow bg-light">
          <div class="card-body text-center py-4">
            <h4 class="mt-2">
              <i class="fa fa-lg fa-user"></i>
              {{ $usersCount }} Users 
            </h4>
            <p>
              Total users registered
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
