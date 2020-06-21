@if(Session::has('message'))
  <div class="alert alert-success" id="add-message-alert" role="alert">{{ Session::get('message') }}</div>
@endif
