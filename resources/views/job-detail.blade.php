<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} - KarirKu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c7c7c7;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a0a0a0;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    <nav class="glass-nav fixed w-full z-50 border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="group flex items-center gap-2 text-slate-600 hover:text-primary-600 transition duration-200">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-primary-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span class="font-semibold text-sm">Kembali</span>
                </a>
                <div class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-purple-600">
                    KarirKu
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-12 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50 group-hover:opacity-100 transition duration-700"></div>

                    <div class="relative z-10 flex flex-col sm:flex-row items-start gap-6">
                        <div class="flex-shrink-0">
                            @if($job->employer && $job->employer->logo)
                            <img class="h-20 w-20 rounded-2xl object-contain bg-white border border-slate-100 shadow-xl" src="{{ asset('storage/' . $job->employer->logo) }}" alt="Logo">
                            @else
                            <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg shadow-primary-200">
                                {{ substr($job->employer->name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $job->title }}</h1>
                            <div class="mt-2 flex flex-wrap items-center gap-3 text-sm font-medium text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    {{ $job->employer->name }}
                                </span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $job->location }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-xl flex flex-col items-center text-center gap-2 hover:-translate-y-1 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Gaji</p>
                            <p class="text-sm font-bold text-slate-800">{{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : 'Gaji Disembunyikan' }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-xl flex flex-col items-center text-center gap-2 hover:-translate-y-1 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Divisi</p>
                            <p class="text-sm font-bold text-slate-800">{{ $job->department }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-xl flex flex-col items-center text-center gap-2 hover:-translate-y-1 transition duration-300">
                        <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium">Deadline</p>
                            <p class="text-sm font-bold text-red-600">{{ $job->expires_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Deskripsi Pekerjaan</h3>

                    <div class="prose prose-slate prose-lg max-w-none text-slate-600 leading-relaxed">
                        {!! $job->description !!}
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-28">
                    <div class="bg-white rounded-3xl shadow-xl shadow-primary-900/5 border border-primary-100 overflow-hidden">

                        <div class="bg-gradient-to-r from-primary-600 to-purple-600 px-6 py-5">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Lamar Sekarang
                            </h3>
                            <p class="text-primary-100 text-sm mt-1">Isi formulir di bawah ini dengan lengkap.</p>
                        </div>

                        @if(session('success'))
                        <div class="mx-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('job.apply', $job) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                            @csrf

                            {{-- Input Nama Lengkap (Read Only) --}}
                            <div>
                                <label for="full_name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="full_name"
                                    id="full_name"
                                    value="{{ auth()->user()->name ?? '' }}"
                                    readonly
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-slate-200 text-slate-500 cursor-not-allowed focus:outline-none select-none">
                            </div>

                            {{-- Input Email (Read Only) --}}
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ auth()->user()->email ?? '' }}"
                                    readonly
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-slate-200 text-slate-500 cursor-not-allowed focus:outline-none select-none">
                            </div>

                            <div x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Upload CV (PDF)</label>
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 rounded-xl cursor-pointer bg-slate-50 hover:bg-primary-50 hover:border-primary-300 transition-colors group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-slate-400 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="text-sm text-slate-500 group-hover:text-primary-600 transition-colors"><span class="font-semibold">Klik untuk upload</span></p>
                                        <p class="text-xs text-slate-400 mt-1" x-text="fileName ? fileName : 'Maks. 2MB (PDF)'"></p>
                                    </div>
                                    <input type="file" name="cv" accept=".pdf" class="hidden" @change="fileName = $event.target.files[0].name">
                                </label>
                            </div>

                            <div x-data="{ fileName: '' }">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Foto KTP</label>
                                <div class="relative">
                                    <input type="file" name="ktp" id="ktp" accept="image/*" class="hidden" @change="fileName = $event.target.files[0].name">
                                    <label for="ktp" class="flex items-center justify-between px-4 py-2.5 border border-slate-300 rounded-xl bg-slate-50 cursor-pointer hover:bg-white focus-within:ring-2 focus-within:ring-primary-500 transition-all">
                                        <span class="text-sm text-slate-500 truncate" x-text="fileName ? fileName : 'Pilih file gambar...'"></span>
                                        <span class="bg-white border border-slate-200 text-slate-600 text-xs font-semibold px-2 py-1 rounded shadow-xl">Browse</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gray-900 text-white font-bold text-sm hover:bg-primary-600 hover:shadow-lg hover:shadow-primary-600/30 transform hover:-translate-y-0.5 transition-all duration-200 flex justify-center items-center gap-2">
                                <span>Kirim Lamaran</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <p class="text-center text-xs text-slate-400">
                                Dengan melamar, Anda menyetujui <a href="#" class="underline hover:text-slate-600">syarat & ketentuan</a> kami.
                            </p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>