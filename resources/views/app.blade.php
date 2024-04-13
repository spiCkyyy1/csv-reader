<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Home owner') }}</title>

    <link rel="apple-touch-icon" sizes="180x180"  href="{{ asset('storage/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"  href="{{ asset('storage/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"  href="{{ asset('storage/favicon-16x16.png') }}">
{{--    <link rel="manifest"  href="{{ asset('site.webmanifest') }}">--}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap"
        rel="stylesheet" />
    <!-- Scripts -->
{{--    @routes--}}
    @vite('resources/css/app.scss')
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
