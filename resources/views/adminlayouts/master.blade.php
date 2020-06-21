@include('adminlayouts._header')

<div id="app">
  @include('adminlayouts._navbar')

  @yield('banner')

  <div class="container py-4">
    @include('adminlayouts._message')
    @include('adminlayouts._errors')

    @yield('content')
  </div>
</div>

@include('adminlayouts._footer')
