<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title> @yield('title') </title>

    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <script>
      window.App = {!!
          json_encode([
              'user' => Auth::guard('admin')->user(),
              'signedIn' => Auth::guard('admin')->check()
          ])
      !!}
    </script>

    @yield('links')

  </head>
  <body>
