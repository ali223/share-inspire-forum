@include('admin.layouts._header')

<div id="app">
  @include('admin.layouts._navbar')

  @yield('banner')

  <div class="container py-4">
    @include('admin.layouts._message')
    @include('admin.layouts._errors')

    @yield('content')
  </div>
</div>

@include('admin.layouts._footer')
