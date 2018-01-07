@include('adminlayouts.header')

<div id="app">
	@include('adminlayouts.navbar')
	@yield('content')
</div>

@include('adminlayouts.footer')
