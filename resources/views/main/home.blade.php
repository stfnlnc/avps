<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @vite(['resources/admin/css/app.css', 'resources/admin/js/app.js'])
</head>
    <body class="">

@if(session('success'))
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="alert alert--success"
    >{{ session('success') }}</p>
@endif
@if(session('danger'))
    <p
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 2000)"
        class="alert alert--danger"
    >{{ session('danger') }}</p>
@endif
    </body>
