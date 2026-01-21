<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-white to-indigo-50">

        <div class="mb-0">
            <a href="/" class="flex items-center gap-2 group">
                <div class="bg-indigo-600 text-white p-2 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:rotate-12 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="font-bold text-2xl text-slate-900 tracking-tight">Karir<span class="text-indigo-600">Ku</span></span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-xl shadow-slate-200/60 overflow-hidden sm:rounded-3xl border border-slate-100">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-slate-400">
            &copy; {{ date('Y') }} KarirKu. All rights reserved.
        </div>
    </div>
</body>

</html>