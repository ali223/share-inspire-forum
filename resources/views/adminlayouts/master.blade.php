@include('adminlayouts.header')

<div id="app">
	@include('adminlayouts.navbar')

  @yield('banner')

  <div class="container py-4">
    @include('adminlayouts.message')
    @include('adminlayouts.errors')

    @yield('content')
  </div>
</div>

@include('adminlayouts.footer')
