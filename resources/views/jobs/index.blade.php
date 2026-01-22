<x-app-layout>

    <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-purple-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    </div>

    <div class="flex min-h-screen">

        {{-- MAIN CONTENT --}}
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">

            {{-- Header Title & Breadcrumb --}}
            <div class="mb-8">
                <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                    <span>Dashboard</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-primary-600 font-medium">Ringkasan</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">Selamat datang, {{ Auth::user()->name }}! 👋</h2>
            </div>

            {{-- Warning Alert --}}
            @if(Auth::user()->hasIncompleteProfile())
            <div class="mb-8 p-4 bg-orange-50 border border-orange-200 rounded-2xl flex items-start gap-4 shadow-sm">
                <div class="p-2 bg-orange-100 rounded-full text-orange-600 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-orange-800">Lengkapi Profil Perusahaan Anda</h4>
                    <p class="text-sm text-orange-700 mt-1">Agar lowongan terlihat lebih profesional dan terpercaya di mata kandidat, mohon lengkapi logo dan deskripsi perusahaan.</p>

                    <a href="{{ route('employer.edit') }}"
                        class="inline-block mt-2 px-4 py-1.5 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-lg transition">
                        Lengkapi Sekarang
                    </a>
                </div>
            </div>
            @endif

            {{-- GRID LAYOUT UTAMA --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- LEFT COLUMN (Checklist & Jobs) --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- Card: Checklist Setup (Mirip "Checklist setup domain") --}}
                    <div class="bg-white/80 backdrop-blur-xl border border-white/60 rounded-3xl shadow-sm p-6">
                        @php
                        // --- LOGIKA MENGHITUNG PROGRESS ---

                        // Mulai dari 1 (Karena Step 1: "Buat Akun" pasti sudah selesai jika user login)
                        $completedSteps = 1;

                        // Cek Step 2 (Profil Perusahaan)
                        if (! Auth::user()->hasIncompleteProfile()) {
                        $completedSteps++;
                        }

                        // Cek Step 3 (Posting Job Pertama)
                        // Pastikan fungsi hasPostedJob() sudah ada di Model User (seperti di jawaban sebelumnya)
                        if (Auth::user()->hasPostedJob()) {
                        $completedSteps++;
                        }

                        // Hitung persentase untuk lebar bar (33%, 66%, atau 100%)
                        $percentage = ($completedSteps / 3) * 100;
                        @endphp

                        <div class="mb-8">
                            {{-- Bagian Header Teks & Angka --}}
                            <div class="flex justify-between items-end mb-3">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">Langkah Persiapan Rekrutmen</h3>
                                    <p class="text-sm text-slate-500 mt-1">Lengkapi data agar perusahaan Anda terlihat profesional.</p>
                                </div>

                                <div class="text-right">
                                    <div class="flex items-baseline justify-end gap-1">
                                        <span class="text-xl font-bold text-primary-600">{{ $completedSteps }}</span>
                                        <span class="text-sm font-semibold text-slate-400">/ 3</span>
                                    </div>
                                    <div class="text-xs font-medium text-slate-500 uppercase tracking-wider">Selesai</div>
                                </div>
                            </div>

                            {{-- Progress Bar Visual --}}
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden shadow-inner">
                                <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-full rounded-full transition-all duration-1000 ease-out relative"
                                    style="width: {{ $percentage }}%">

                                    {{-- Efek Kilauan (Optional) --}}
                                    <div class="absolute top-0 left-0 bottom-0 right-0 bg-white/20 w-full h-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Step 1: Done --}}
                            <div class="flex items-center justify-between p-4 bg-green-50/50 border border-green-100 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center text-white">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-slate-700 font-medium line-through decoration-slate-400">Buat Akun Employer</span>
                                </div>
                            </div>

                            {{-- Step 2: Complete Profile --}}
                            @if( ! Auth::user()->hasIncompleteProfile() )
                            <div class="flex items-center justify-between p-4 bg-green-50/50 border border-green-100 rounded-xl transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center text-white">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-slate-700 font-medium line-through decoration-slate-400">Lengkapi Profile Perusahaan</span>
                                </div>
                            </div>
                            @else
                            <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm hover:border-primary-300 transition cursor-pointer group">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        {{-- Lingkaran Kosong (Indikator Belum Selesai) --}}
                                        <div class="h-6 w-6 rounded-full border-2 border-slate-300 group-hover:border-primary-500 flex items-center justify-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-transparent group-hover:bg-primary-500 transition"></div>
                                        </div>
                                        <span class="text-slate-800 font-semibold">Lengkapi Profile Perusahaan</span>
                                    </div>

                                    <a href="{{ route('employer.edit') }}" class="text-primary-600 hover:text-primary-800">
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                {{-- Deskripsi Pendek --}}
                                <div class="mt-2 pl-9">
                                    <p class="text-sm text-slate-500 mb-3">Wajib diisi agar lowongan bisa ditayangkan.</p>
                                    <a href="{{ route('employer.edit') }}" class="inline-block px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-xs font-bold rounded-lg transition">
                                        Lengkapi Sekarang
                                    </a>
                                </div>
                            </div>

                            @endif

                            {{-- Logic Preparation --}}
                            @php
                            $isProfileComplete = !Auth::user()->hasIncompleteProfile(); // True jika Step 2 selesai
                            $hasPostedJob = Auth::user()->hasPostedJob(); // True jika Step 3 selesai
                            @endphp

                            <div class="border rounded-xl shadow-sm transition-all duration-300 
    {{ $hasPostedJob ? 'bg-primary-50 border-primary-200' : 'bg-white border-slate-200' }}
    {{ !$isProfileComplete ? 'opacity-50 grayscale cursor-not-allowed' : 'hover:border-primary-300' }}">

                                @if($hasPostedJob)
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center text-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-slate-700 font-bold line-through decoration-slate-400">Posting Lowongan Pertama Anda</span>
                                    </div>
                                    <span class="text-xs font-bold text-green-600 bg-green-100 px-2 py-1 rounded-lg">Selesai</span>
                                </div>

                                @elseif($isProfileComplete)
                                <div class="p-4">
                                    <div class="flex justify-between items-center mb-3">
                                        <div class="flex items-center gap-3">
                                            {{-- Icon Bulat Kosong (Indikator Step) --}}
                                            <div class="h-6 w-6 rounded-full border-2 border-primary-600 flex items-center justify-center">
                                                <div class="h-2.5 w-2.5 rounded-full bg-primary-600 animate-pulse"></div>
                                            </div>
                                            <span class="text-slate-800 font-bold">Posting Lowongan Pertama Anda</span>
                                        </div>
                                    </div>

                                    <div class="pl-9">
                                        <p class="text-sm text-slate-500 mb-4">
                                            Mulai dapatkan kandidat terbaik dengan mempublikasikan lowongan pekerjaan sekarang.
                                        </p>
                                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white text-sm font-bold rounded-lg hover:bg-primary-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            Buat Lowongan Sekarang
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                @else
                                <div class="p-4 pointer-events-none select-none">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3">
                                            {{-- Icon Gembok --}}
                                            <div class="h-6 w-6 rounded-full border-2 border-slate-300 bg-slate-100 flex items-center justify-center text-slate-400">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-slate-500 font-semibold">Posting Lowongan Pertama Anda</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 border border-slate-200 px-2 py-0.5 rounded uppercase tracking-wider">
                                            Terkunci
                                        </span>
                                    </div>
                                    <div class="pl-9 mt-2 text-xs text-slate-400">
                                        Selesaikan profil perusahaan terlebih dahulu.
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                    $myJobs = Auth::user()->getRecentEmployerJobs(3);
                    @endphp

                    <div>
                        {{-- Header Section --}}
                        <div class="flex justify-between items-end mb-4">
                            <h3 class="text-xl font-bold text-slate-800">Lowongan Terbaru</h3>
                            {{-- Link ke halaman list semua job milik perusahaan --}}
                            <a href="{{ route('jobs.list') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-800">
                                Lihat Semua
                            </a>
                        </div>

                        {{-- Table Section --}}
                        <div class="bg-white/80 backdrop-blur-xl border border-white/60 rounded-3xl shadow-sm overflow-hidden">
                            <table class="min-w-full divide-y divide-slate-100">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Posisi</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Status</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    {{-- Loop Data Milik User --}}
                                    @forelse ($myJobs as $job)
                                    <tr class="hover:bg-primary-50/30 transition group">
                                        {{-- Kolom Posisi --}}
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-800">{{ $job->title }}</div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $job->location ?? 'Lokasi tidak diset' }}
                                            </div>
                                        </td>

                                        {{-- Kolom Status (Logika Sederhana) --}}
                                        <td class="px-6 py-4">
                                            @if($job->expires_at < now())
                                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                                Berakhir
                                                </span>
                                                @else
                                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                    Aktif
                                                </span>
                                                @endif
                                        </td>

                                        {{-- Kolom Aksi --}}
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('jobs.edit', $job) }}" class="text-primary-600 font-medium text-sm hover:underline flex items-center justify-end gap-1">
                                                Kelola
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    {{-- Tampilan Jika Tidak Ada Data --}}
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-slate-400">
                                                <svg class="w-12 h-12 mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="text-sm font-medium">Belum ada lowongan yang dibuat.</p>
                                                {{-- 1. SETUP LOGIKA & DATA --}}
                                                @php
                                                // Cek apakah profil employer BELUM lengkap
                                                // True = Profil Belum Lengkap (Tampilkan Popup)
                                                // False = Profil Lengkap (Langsung ke Link)
                                                $isIncomplete = Auth::user()->hasIncompleteProfile();
                                                @endphp

                                                {{-- Bungkus dengan x-data untuk mengontrol state Modal --}}
                                                <div x-data="{ showAlert: false, isIncomplete: {{ $isIncomplete ? 'true' : 'false' }} }">

                                                    {{-- 2. TOMBOL PEMICU (Yang Anda minta diedit) --}}
                                                    <a href="{{ route('jobs.create') }}"
                                                        @click.prevent="if(isIncomplete) { showAlert = true } else { window.location.href = '{{ route('jobs.create') }}' }"
                                                        class="mt-2 text-primary-600 hover:underline text-sm font-bold cursor-pointer inline-block">
                                                        Buat Lowongan Baru
                                                    </a>

                                                    {{-- 3. MODAL POPUP (Overlay + Content) --}}
                                                    <template x-teleport="body">
                                                        <div x-show="showAlert"
                                                            style="display: none;"
                                                            class="fixed inset-0 z-50 flex items-center justify-center px-4"
                                                            aria-labelledby="modal-title" role="dialog" aria-modal="true">

                                                            {{-- A. Background Blur / Overlay --}}
                                                            <div x-show="showAlert"
                                                                x-transition:enter="ease-out duration-300"
                                                                x-transition:enter-start="opacity-0"
                                                                x-transition:enter-end="opacity-100"
                                                                x-transition:leave="ease-in duration-200"
                                                                x-transition:leave-start="opacity-100"
                                                                x-transition:leave-end="opacity-0"
                                                                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                                                                @click="showAlert = false"></div>

                                                            {{-- B. Kotak Modal --}}
                                                            <div x-show="showAlert"
                                                                x-transition:enter="ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave="ease-in duration-200"
                                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-md w-full border border-slate-100">

                                                                {{-- Hiasan Header (Header Ungu) --}}
                                                                <div class="bg-primary-50 px-4 py-6 text-center relative overflow-hidden">
                                                                    {{-- Lingkaran dekorasi --}}
                                                                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 rounded-full bg-primary-100 opacity-50"></div>
                                                                    <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-primary-100 opacity-50"></div>

                                                                    {{-- Icon Besar --}}
                                                                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-white shadow-md mb-2 relative z-10">
                                                                        <svg class="h-8 w-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <h3 class="text-lg leading-6 font-bold text-slate-800 relative z-10" id="modal-title">
                                                                        Profil Perusahaan Belum Lengkap
                                                                    </h3>
                                                                </div>

                                                                {{-- Isi Pesan --}}
                                                                <div class="px-6 py-4">
                                                                    <p class="text-sm text-slate-500 text-center">
                                                                        Halo! Sebelum memposting lowongan pekerjaan, Anda perlu melengkapi data profil perusahaan terlebih dahulu agar terlihat profesional oleh pelamar.
                                                                    </p>
                                                                </div>

                                                                {{-- Tombol Aksi --}}
                                                                <div class="px-6 pb-6 sm:flex sm:flex-row-reverse sm:gap-2">
                                                                    {{-- Tombol Utama: Ke Halaman Edit Profil --}}
                                                                    <a href="{{ route('jobs.create') }}" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg shadow-primary-200 px-4 py-2.5 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm transition transform hover:-translate-y-0.5">
                                                                        Lengkapi Profil Sekarang
                                                                    </a>
                                                                    {{-- Tombol Batal --}}
                                                                    <button type="button" @click="showAlert = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-200 shadow-sm px-4 py-2.5 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:text-sm transition">
                                                                        Nanti Saja
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-4 space-y-6">

                    @php
                    $urgentJob = Auth::user()->getUrgentJob();
                    $cardLink = $urgentJob ? route('jobs.edit', $urgentJob) : route('dashboard');
                    @endphp

                    <a href="{{ $cardLink }}"
                        class="block bg-white rounded-3xl shadow-md border {{ $urgentJob ? 'border-red-100 ring-2 ring-red-50' : 'border-green-100' }} p-6 relative overflow-hidden group transition hover:shadow-lg hover:-translate-y-1">

                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition pointer-events-none">
                            <svg class="w-32 h-32 {{ $urgentJob ? 'text-red-500' : 'text-green-500' }} transform rotate-12" fill="currentColor" viewBox="0 0 20 20">
                                @if($urgentJob)

                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                @else

                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                @endif
                            </svg>
                        </div>


                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <h3 class="font-bold text-xl text-slate-800 line-clamp-1 pr-2">
                                {{ $urgentJob ? $urgentJob->title : 'Belum ada Job Urgent' }}
                            </h3>

                            @if($urgentJob)
                            <span class="shrink-0 px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-lg animate-pulse">
                                Segera Berakhir
                            </span>
                            @else
                            <span class="shrink-0 px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-lg">
                                Aman
                            </span>
                            @endif
                        </div>


                        <div class="flex items-center gap-4 mb-6 relative z-10">

                            <div class="h-12 w-12 rounded-full border-4 {{ $urgentJob ? 'border-red-100' : 'border-green-100' }} flex items-center justify-center bg-white shadow-sm">
                                <svg class="w-6 h-6 {{ $urgentJob ? 'text-red-500' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($urgentJob)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>
                            </div>


                            <div>
                                <p class="text-xs text-slate-500 font-medium">
                                    {{ $urgentJob ? 'Deadline Lamaran' : 'Status Lowongan' }}
                                </p>
                                <p class="text-lg font-bold {{ $urgentJob ? 'text-red-600' : 'text-slate-800' }}">
                                    @if($urgentJob)
                                    {{ \Carbon\Carbon::parse($urgentJob->closing_date)->translatedFormat('d M Y') }}
                                    @else
                                    Semua Aman
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 relative z-10">
                            @if($urgentJob)
                            <span class="text-sm text-red-500 font-medium italic">Klik untuk kelola</span>
                            <svg class="w-5 h-5 text-red-400 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            @else
                            <span class="text-sm text-slate-500 font-medium">Lowongan aktif berjalan baik</span>
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                        </div>

                    </a>

                    @php
                    $stats = Auth::user()->getQuickStats();
                    @endphp

                    <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6">
                        {{-- Header Kartu --}}
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-bold text-slate-800">Statistik Cepat</h4>
                            {{-- Link ini bisa diarahkan ke halaman analytics jika ada --}}
                            <a href="{{ route('jobs.statistik') }}" class="text-xs text-primary-600 font-bold hover:underline">Lihat Detail</a>
                        </div>

                        <div class="space-y-3">
                            {{-- 1. Total Pelamar Minggu Ini --}}
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Pelamar Baru</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $stats->applicants }} Kandidat
                                    </p>
                                    <span class="text-[10px] text-slate-400 font-normal">(Minggu ini)</span>
                                </div>
                            </div>

                            {{-- 2. Total Lowongan --}}
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Lowongan</p>
                                <p class="text-sm font-medium text-slate-700">
                                    {{ $stats->jobs }} Loker Aktif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Card: Contact Info (Informasi Perusahaan) --}}
                    <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6">

                        {{-- Header Card --}}
                        <div class="flex justify-between items-center mb-5">
                            <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                Profil Perusahaan
                            </h4>
                            <a href="{{ route('employer.edit') }}" class="text-xs text-indigo-600 font-bold hover:text-indigo-800 transition">
                                {{ auth()->user()->hasIncompleteProfile() ? 'Lengkapi' : 'Edit' }}
                            </a>
                        </div>

                        {{-- KONTEN CARD --}}
                        @if(auth()->user()->hasIncompleteProfile())

                        {{-- STATE 1: BELUM MENGISI PROFIL --}}
                        <div class="flex flex-col items-center justify-center text-center py-4 bg-amber-50 rounded-xl border border-amber-100 p-4">
                            <div class="bg-amber-100 p-3 rounded-full mb-3 text-amber-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-amber-800 mb-1">Data Belum Lengkap</p>
                            <p class="text-xs text-amber-600 mb-3">Anda belum mengisi profil perusahaan.</p>

                            <a href="{{ route('employer.edit') }}" class="px-4 py-2 text-xs font-bold text-white bg-amber-600 rounded-lg hover:bg-amber-700 transition">
                                Lengkapi Sekarang
                            </a>
                        </div>

                        @else

                        {{-- STATE 2: SUDAH ADA DATA --}}
                        <div class="space-y-4">

                            {{-- Nama Perusahaan --}}
                            <div class="flex items-start gap-3">
                                <div class="mt-1 p-2 bg-indigo-50 text-indigo-600 rounded-lg shrink-0">
                                    {{-- Icon Building --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Nama Perusahaan</span>
                                    <span class="text-slate-800 font-bold truncate text-sm">
                                        {{ auth()->user()->employer->name ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="flex items-start gap-3">
                                <div class="mt-1 p-2 bg-emerald-50 text-emerald-600 rounded-lg shrink-0">
                                    {{-- Icon Map Pin --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Lokasi</span>
                                    <span class="text-slate-700 font-medium text-sm leading-snug">
                                        {{ auth()->user()->employer->address ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Website --}}
                            <div class="flex items-start gap-3">
                                <div class="mt-1 p-2 bg-sky-50 text-sky-600 rounded-lg shrink-0">
                                    {{-- Icon Globe --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wider">Website</span>
                                    @if(!empty(auth()->user()->employer->website))
                                    <a href="{{ auth()->user()->employer->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium text-sm truncate">
                                        {{ auth()->user()->employer->website }}
                                    </a>
                                    @else
                                    <span class="text-slate-400 text-sm italic">- Tidak ada website -</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>