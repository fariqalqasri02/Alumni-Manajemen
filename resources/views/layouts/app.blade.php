<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="shell-page">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-slate-200/70 bg-white/70 backdrop-blur">
                    <div class="shell-container py-5 md:py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="page-content">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
