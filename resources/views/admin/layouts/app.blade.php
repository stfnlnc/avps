<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex">
        <link rel="icon" href="" />
        <title>@hasSection('title')@yield('title') - @endif {{ config('app.name') }}</title>
        @vite(['resources/admin/css/app.css', 'resources/admin/js/app.js'])
    </head>
    <body class="">
        <div class="container__full-width flex col">
            @include('admin.layouts.navigation')

            <main>
                @if (isset($header))
                    <header class="container pt--4 pb--4">
                        <h5>
                            {{ $header }}
                        </h5>
                    </header>
                    @if(session('success'))
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="alert alert--success"
                        >{{ session('success') }}</p>
                    @endif
                    @if(session('danger'))
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="alert alert--danger"
                        >{{ session('danger') }}</p>
                    @endif
                    @if($errors->any())
                        <div class="alert alert--danger">
                            <div class="flex col gap--2">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
