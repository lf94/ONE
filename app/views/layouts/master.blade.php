<!DOCTYPE html>
<html>
    <head>
        <title>ONE | @yield('title')</title>
        <!-- Bootstrap from MaxCDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- ONE CSS -->
        {{ HTML::style('assets/styles/one.css') }}
        @yield('head')
    </head>
    <body>
        @include('layouts/navigation')
        <div class="container">
            @yield('before-content')
        <div class="row">
            @yield('sidebar')
            @yield('content')
        </div>
    </body>
</html>


