<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    
    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" type="text/css" href="/css/styles.css">

    @yield('links')

  </head>
  <body>
