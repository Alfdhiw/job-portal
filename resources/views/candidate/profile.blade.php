<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Karir Ku') }} - Profil Saya</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50">

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
                    @if(Auth::user()->role === 'employer')
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-900 rounded-full hover:bg-primary-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Dashboard
                    </a>

                    @elseif(Auth::user()->role === 'superadmin')
                    <a href="{{ route('superadmin.dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-900 rounded-full hover:bg-primary-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Dashboard
                    </a>

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
    <div class="relative min-h-screen flex flex-col items-center pt-10 sm:pt-16 bg-gray-50">

        <div class="w-full max-w-4xl px-6 lg:px-8">

            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Halo, {{ $user->name }}! 👋
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Kelola data diri Anda untuk melamar pekerjaan impian.
                </p>
            </div>

            @if (session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center gap-3 text-emerald-700 shadow-sm">
                <svg class="w-6 h-6 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8">
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900">Edit Profil Dasar</h2>
                            <p class="text-sm text-gray-500 mt-1">Perbarui nama dan email yang digunakan untuk login.</p>
                        </div>

                        <form method="post" action="{{ route('candidate.profile.update') }}" class="space-y-5">
                            @csrf
                            @method('put')

                           
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" name="email" id="email"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition bg-gray-50"
                                    value="{{ old('email', $user->email) }}" required>
                                <p class="text-xs text-gray-400 mt-1">Pastikan email ini aktif untuk menerima info lowongan.</p>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div class="pt-4">
                                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                   
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8 mt-8">
                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-900">Ganti Password</h2>
                            <p class="text-sm text-gray-500 mt-1">Gunakan password yang kuat untuk menjaga keamanan akun.</p>
                        </div>

                        <form method="post" action="{{ route('candidate.password.update') }}" class="space-y-5">
                            @csrf
                            @method('put')

                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition"
                                    autocomplete="current-password">
                                @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                           
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" name="password" id="password"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition"
                                    autocomplete="new-password">
                                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition"
                                    autocomplete="new-password">
                                @error('password_confirmation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div class="pt-4">
                                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

               
                <div class="md:col-span-1 space-y-6">

                  
                    <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-4 text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-indigo-900 mb-2">Tips Kandidat</h3>
                        <p class="text-sm text-indigo-800 leading-relaxed">
                            Gunakan nama asli yang sesuai dengan KTP atau Ijazah agar memudahkan perusahaan dalam memverifikasi lamaran Anda.
                        </p>
                    </div>

                    
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-3">Status Akun</h3>
                        <div class="flex items-center gap-2">
                            <span class="flex w-3 h-3 bg-green-500 rounded-full"></span>
                            <span class="text-sm text-gray-600">Aktif sebagai Kandidat</span>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <p class="text-xs text-gray-400">Bergabung sejak {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="mt-20 py-6 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>