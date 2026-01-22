<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KarirKu - Temukan Pekerjaan Impianmu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-primary-50 text-gray-800 font-sans antialiased">

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <div class="bg-primary-600 text-white p-1.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-gray-900 tracking-tight">Karir<span class="text-primary-600">Ku</span></span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                    @auth
                    {{-- LOGIKA 1: JIKA EMPLOYER (Tampilkan Tombol Dashboard) --}}
                    @if(Auth::user()->role === 'employer')
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-900 rounded-full hover:bg-primary-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Dashboard
                    </a>

                    @elseif(Auth::user()->role === 'superadmin')
                    <a href="{{ route('superadmin.dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-900 rounded-full hover:bg-primary-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Dashboard
                    </a>

                    {{-- LOGIKA 2: JIKA CANDIDATE (Tampilkan Dropdown User) --}}
                    @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 text-sm font-semibold text-gray-700 hover:text-primary-600 transition focus:outline-none">
                            <span>Hi, {{ Auth::user()->name }}</span>
                            <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <svg class="h-4 w-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open"
                            style="display: none;"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50 origin-top-right ring-1 ring-black ring-opacity-5">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-900 font-bold truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- Kamu bisa tambahkan menu edit profile disini jika mau --}}
                            <a href="{{ route('candidate.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Edit Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-medium transition">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                    @endif

                    @else
                    {{-- LOGIKA 3: JIKA TAMU (Login & Register) --}}
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-primary-600 transition">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hidden md:inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-full text-white bg-primary-900 hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Sign Up
                    </a>
                    @endif
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden bg-gradient-to-r from-primary-900 via-purple-800 to-primary-900 animate-gradient">

        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="particle w-2 h-2 left-[10%]" style="animation-duration: 7s; animation-delay: 0s;"></div>
            <div class="particle w-3 h-3 left-[20%]" style="animation-duration: 10s; animation-delay: 2s;"></div>
            <div class="particle w-1 h-1 left-[50%]" style="animation-duration: 5s; animation-delay: 4s;"></div>
            <div class="particle w-2 h-2 left-[80%]" style="animation-duration: 8s; animation-delay: 1s;"></div>
            <div class="particle w-4 h-4 left-[90%]" style="animation-duration: 12s; animation-delay: 3s;"></div>
        </div>

        <div class="absolute top-0 left-0 w-full h-full opacity-10 z-0 pointer-events-none">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path fill="white">
                    <animate
                        attributeName="d"
                        dur="20s"
                        repeatCount="indefinite"
                        values="
                    M0 100 C 20 0 80 0 100 100 Z;
                    M0 100 C 40 30 60 30 100 100 Z;
                    M0 100 C 20 0 80 0 100 100 Z
                " />
                </path>
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                Temukan Karir <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300">Impianmu</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-xl text-primary-100">
                Ribuan lowongan kerja terbaru dari perusahaan top menanti lamaranmu. Mulai perjalanan karirmu sekarang.
            </p>

            <div class="mt-10 max-w-4xl mx-auto">
                <div class="bg-white p-3 rounded-2xl shadow-xl border border-gray-200">
                    <form action="{{ route('public.jobs') }}" method="GET" class="flex flex-col md:flex-row gap-3">

                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-3 border-none rounded-xl bg-primary-50 focus:bg-white focus:ring-2 focus:ring-primary-500 transition placeholder-gray-400 font-medium"
                                placeholder="Posisi atau Nama Perusahaan...">
                        </div>

                        <div class="w-full md:w-1/4 relative border-l-0 md:border-l border-gray-200 md:pl-3">
                            <div class="absolute inset-y-0 left-3 md:left-6 pl-0 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm font-semibold">Rp</span>
                            </div>
                            <input type="number" name="min_salary" value="{{ request('min_salary') }}"
                                class="block w-full pl-8 md:pl-10 pr-3 py-3 border-none rounded-xl bg-primary-50 focus:bg-white focus:ring-2 focus:ring-primary-500 transition placeholder-gray-400 font-medium"
                                placeholder="Min. Gaji">
                        </div>

                        <button type="submit" class="bg-primary-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-700 transition transform hover:-translate-y-0.5 shadow-lg shadow-primary-500/30 flex items-center justify-center gap-2">
                            Cari
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                @if(request('search') || request('min_salary'))
                <div class="mt-4 text-center">
                    <span class="text-gray-50 text-sm mr-2">Menampilkan hasil pencarian.</span>
                    {{-- Arahkan reset ke public.jobs tanpa parameter --}}
                    <a href="{{ route('public.jobs') }}" class="text-blue-50 underline text-sm hover:text-purple-600 transition">
                        Reset Filter
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Lowongan Terbaru</h2>
                <p class="mt-2 text-gray-500">Temukan peluang terbaik yang sesuai dengan keahlianmu.</p>
            </div>
        </div>

        @forelse($jobs as $job)
        <div class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:border-primary-100 transition duration-300 mb-4 relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary-400 to-primary-600 opacity-0 group-hover:opacity-100 transition"></div>

            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="flex gap-4">
                    <div class="h-14 w-14 rounded-xl bg-primary-50 border border-gray-100 flex items-center justify-center shrink-0">
                        {{-- Cek apakah data employer ada DAN memiliki logo --}}
                        @if($job->employer && $job->employer->logo)
                        <img src="{{ asset('storage/' . $job->employer->logo) }}"
                            alt="{{ $job->employer->name }}"
                            class="h-10 w-10 object-contain">
                        @else
                        {{-- Jika tidak ada logo, tampilkan inisial dari Nama Perusahaan (Employer) --}}
                        <span class="text-2xl font-bold text-primary-600">
                            {{ substr($job->employer->name ?? 'C', 0, 1) }}
                        </span>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary-700 transition">
                            <p>{{ $job->title }}</p>
                        </h3>
                        <p class="text-sm text-gray-500 font-medium">{{ $job->employer->name }}</p>

                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                {{$job->department}}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                Rp {{ number_format($job->salary, 0, ',', '.') }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-primary-50 text-gray-600 border border-gray-100">
                                {{$job->location}}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row md:flex-col items-center md:items-end justify-between w-full md:w-auto mt-4 md:mt-0 gap-4">
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $job->created_at->diffForHumans() }}
                    </span>

                    <div x-data="{ showLoginModal: false }" class="w-full md:w-auto">

                        {{-- KONDISI 1: User Sudah Login (Langsung ke Link) --}}
                        @auth
                        <a href="{{ route('job.show', $job->id) }}"
                            class="inline-flex justify-center items-center w-full md:w-auto px-6 py-2 bg-primary-900 text-white text-sm font-bold rounded-xl hover:bg-primary-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            Lamar Sekarang
                        </a>
                        @endauth

                        {{-- KONDISI 2: User Belum Login (Munculkan Popup) --}}
                        @guest
                        <button @click="showLoginModal = true"
                            class="inline-flex justify-center items-center w-full md:w-auto px-6 py-2 bg-primary-900 text-white text-sm font-bold rounded-xl hover:bg-primary-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            Lamar Sekarang
                        </button>
                        @endguest

                        {{-- MODAL POPUP (Hanya dirender jika user Guest, tapi hidden by default) --}}
                        <template x-teleport="body">
                            <div x-show="showLoginModal"
                                style="display: none;"
                                class="fixed inset-0 z-[99] flex items-center justify-center px-4"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0">

                                <div @click="showLoginModal = false" class="absolute inset-0 bg-primary-900/60 backdrop-blur-sm"></div>

                                <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full relative z-10 overflow-hidden transform transition-all"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                                    <div class="bg-primary-50 p-6 flex justify-center">
                                        <div class="h-16 w-16 bg-primary-100 rounded-full flex items-center justify-center animate-bounce">
                                            <svg class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="px-6 py-4 text-center">
                                        <h3 class="text-lg font-bold text-gray-900">Login Diperlukan</h3>
                                        <p class="text-gray-500 text-sm mt-2">
                                            Anda harus masuk ke akun KarirKu terlebih dahulu untuk melamar pekerjaan ini.
                                        </p>
                                    </div>

                                    <div class="bg-primary-50 px-6 py-4 flex gap-3">
                                        <button @click="showLoginModal = false"
                                            class="flex-1 px-4 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg border border-gray-300 hover:bg-primary-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                                            Batal
                                        </button>
                                        <a href="{{ route('login') }}"
                                            class="flex-1 flex justify-center items-center px-4 py-2 bg-primary-600 text-white text-sm font-semibold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg shadow-primary-200">
                                            Login Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
            <div class="mx-auto h-24 w-24 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Lowongan tidak ditemukan</h3>
            <p class="mt-1 text-gray-500">Coba ubah kata kunci atau kurangi filter gaji Anda.</p>
            <div class="mt-6">
                <a href="{{ route('public.jobs') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200">
                    Reset Pencarian
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <span class="font-bold text-xl text-gray-900">Karir<span class="text-primary-600">Ku</span></span>
            </div>
            <p class="text-gray-500 text-sm">© {{ date('Y') }} KarirKu Portal. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>