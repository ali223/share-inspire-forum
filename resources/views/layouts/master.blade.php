@include('layouts.header')

@include('layouts.navbar')

<div class="container">
  <div class="row">
  	<div class="col-md-12">  	
  		@yield('content')
  	</div>
  </div>	
</div>

@include('layouts.footer')
