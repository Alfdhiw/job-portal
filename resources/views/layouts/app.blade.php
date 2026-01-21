<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        {{-- SIDEBAR: Background Utama menggunakan indigo-900 (#4c1d95) --}}
        <aside class="absolute inset-y-0 left-0 z-50 w-64 bg-indigo-950 text-white transition-transform duration-300 ease-in-out transform md:static md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- HEADER SIDEBAR: Sedikit lebih gelap untuk struktur --}}
            <div class="flex items-center justify-center h-20 bg-indigo-900 border-b border-indigo-800">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    {{-- Logo Box --}}
                    <div class="bg-white p-1.5 rounded-lg shadow-lg shadow-indigo-900/50">
                        <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-wide text-white">Karir<span class="text-indigo-300">Ku</span></span>
                </a>
            </div>

            {{-- NAVIGASI --}}
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                <p class="px-4 text-xs font-bold text-indigo-400 uppercase tracking-wider mb-3">Menu Utama</p>

                {{-- Dashboard Link (Active State tetap terang) --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-indigo-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>
                {{-- Lowongan Link (Active State tetap terang) --}}
                <a href="{{ route('jobs.list') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('jobs.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('jobs.*') ? 'text-white' : 'text-indigo-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Lowongan
                </a>

                {{-- Link Lainnya (Inactive State disesuaikan dengan background baru) --}}
                <a href="{{ route('employer.candidates') }}" class="flex items-center px-4 py-3 text-sm font-medium {{ request()->routeIs('employer.candidates') ? 'bg-indigo-800 text-white' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }} rounded-xl transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('employer.candidates') ? 'text-white' : 'text-indigo-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Kandidat
                </a>
            </nav>

            {{-- USER PROFILE FOOTER --}}
            <div class="border-t border-indigo-800 p-4 bg-indigo-900">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-indigo-700 border border-indigo-600 flex items-center justify-center text-white font-bold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-indigo-300 truncate">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-indigo-400 hover:text-red-300 transition" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT (Tidak Berubah) --}}
        <div class="flex-1 flex flex-col overflow-hidden relative">

            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
                class="fixed inset-0 bg-indigo-900/50 z-40 md:hidden backdrop-blur-sm"></div>

            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-6 py-4 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-indigo-600 md:hidden focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div class="hidden sm:block">
                        @if (isset($header))
                        {{ $header }}
                        @else
                        <h1 class="text-lg font-bold text-slate-800">Dashboard Utama</h1>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="text-slate-400 hover:text-indigo-600 transition relative">
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
    {{-- ========================================== --}}
    {{-- THEMED TOAST NOTIFICATIONS (Purple & White)--}}
    {{-- ========================================== --}}

    {{-- 1. NOTIFIKASI SUKSES (TEMA UNGU/INDIGO) --}}
    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"

        {{-- Animasi Slide Right --}}
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"

        {{-- STYLING: Background Putih, Border Kiri Ungu Tebal --}}
        class="fixed z-50 max-w-sm w-full top-5 right-5 bg-white border-l-4 border-indigo-600 rounded-r-xl shadow-lg shadow-indigo-500/20 overflow-hidden"
        role="alert">
        <div class="p-4 flex items-start gap-4">
            {{-- Icon Ceklis (Lingkaran Ungu Pudar) --}}
            <div class="flex-shrink-0">
                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-50 text-indigo-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <div class="w-full pt-0.5">
                {{-- Judul Kecil (Opsional, memberi konteks) --}}
                <h3 class="text-sm font-bold text-indigo-900">Berhasil!</h3>
                {{-- Pesan Utama --}}
                <div class="mt-1 text-sm text-slate-600">
                    {{ session('success') }}
                </div>
            </div>

            {{-- Tombol Close (X) --}}
            <button @click="show = false" type="button" class="ml-auto text-slate-400 hover:text-indigo-600 focus:outline-none transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Progress Bar effect (Garis jalan di bawah) --}}
        <div class="h-1 bg-indigo-50 w-full absolute">
            <div class="h-full bg-indigo-600 animate-pulse w-full"></div>
        </div>
    </div>
    @endif

    {{-- 2. NOTIFIKASI ERROR (TEMA MERAH ELEGAN) --}}
    @if (session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"

        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"

        {{-- STYLING: Tetap Merah untuk Error, tapi desain senada dengan Ungu --}}
        class="fixed z-50 max-w-sm w-full top-5 right-5 bg-white border-l-4 border-red-500 rounded-r-xl shadow-lg shadow-red-500/10 overflow-hidden"
        role="alert">
        <div class="p-4 flex items-start gap-4">
            {{-- Icon Silang (Lingkaran Merah Pudar) --}}
            <div class="flex-shrink-0">
                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-50 text-red-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <div class="w-full pt-0.5">
                <h3 class="text-sm font-bold text-red-800">Gagal</h3>
                <div class="mt-1 text-sm text-slate-600">
                    {{ session('error') }}
                </div>
            </div>

            <button @click="show = false" type="button" class="ml-auto text-slate-400 hover:text-red-500 focus:outline-none transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    @endif
</body>

</html>