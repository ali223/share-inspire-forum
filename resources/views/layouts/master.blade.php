@include('layouts._header')

<div id="app">
  @include('layouts._navbar')

  @yield('showcase')

  <div class="container py-4">
    @yield('breadcrumbs')

    @include('layouts._message')
    @include('layouts._errors')

    @yield('content')
  </div>
</div>

@include('layouts._footer')
