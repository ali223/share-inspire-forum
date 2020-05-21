@include('layouts.header')
<div id="app">
	@include('layouts.navbar')

  @yield('showcase')

  <div class="container margin-top">
    @include('layouts.message')
    @include('layouts.errors')

    @yield('content')
  </div>
</div>
@include('layouts.footer')
