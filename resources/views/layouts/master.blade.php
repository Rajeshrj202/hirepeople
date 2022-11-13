<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HR Admin - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Hr-Admin">
    <meta name="author" content="Themesberg">
    @include('layouts.styles')
</head>

<body>
    @include('layouts.header')
    @include('layouts.sidebar')
    <main class="content">

        @include('layouts.common')
        @yield('content')

    </main>

</body>
@include('layouts.footer')
@include('layouts.scripts')
</footer>