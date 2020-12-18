<!DOCTYPE html>

<html lang="en" >
    <head>
        <meta charset="utf-8"/>
        <title>Blossom Cage| Admin Portal</title>
        <meta name="description" content="admin login page"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @include('ingredients.css')
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    </head>
    <body  class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >
        @yield('page_content')
        @include('ingredients.js')
    </body>
</html>