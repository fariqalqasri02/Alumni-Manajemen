<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-shell">
            <div class="mx-auto flex min-h-[calc(100vh-4rem)] max-w-6xl items-center justify-center">
                <div class="grid w-full items-center gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                    <div class="hidden text-white lg:block">
                        <span class="badge-soft !bg-white/10 !text-cyan-200">Sistem Manajemen Alumni</span>
                        <h1 class="mt-5 text-5xl font-bold leading-tight">Portal karier yang nyaman dipakai di desktop, tablet, dan mobile.</h1>
                        <p class="mt-5 max-w-xl text-base text-slate-300">Mahasiswa, alumni, dan admin dapat mengelola data, mengakses peluang karier, tracer study, dan laporan dalam satu aplikasi Laravel yang responsif.</p>
                    </div>

                    <div class="mx-auto w-full max-w-lg">
                        <div class="mb-5 flex justify-center lg:hidden">
                            <a href="/">
                                <x-application-logo class="h-16 w-16 fill-current text-white" />
                            </a>
                        </div>
                        <div class="auth-card">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
