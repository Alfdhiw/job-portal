<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-950 leading-tight">
            {{ __('Statistik & Analitik') }}
        </h2>
    </x-slot>

    {{-- Container Utama: Relative diperlukan agar Overlay bisa diposisikan Absolute --}}
    <div class="relative py-12 min-h-screen overflow-hidden">

        {{-- ======================================================================== --}}
        {{-- LAYER 1: KONTEN YANG DIBLUR (BACKGROUND TEASER) --}}
        {{-- ======================================================================== --}}
        {{-- Kita gunakan 'blur-sm', 'opacity-60', dan 'pointer-events-none' agar user tidak bisa klik/select --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 filter blur-[6px] opacity-50 pointer-events-none select-none grayscale-[30%]">

            {{-- Baris 1: Kartu Statistik Dummy --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Total Pengunjung</div>
                    <div class="text-3xl font-black text-slate-800 mt-2">124,592</div>
                    <div class="text-emerald-500 text-sm font-bold mt-2 flex items-center">
                        <span>▲ 12%</span> <span class="text-slate-400 ml-1">bulan ini</span>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Lamaran Masuk</div>
                    <div class="text-3xl font-black text-slate-800 mt-2">8,230</div>
                    <div class="text-emerald-500 text-sm font-bold mt-2 flex items-center">
                        <span>▲ 5.4%</span> <span class="text-slate-400 ml-1">bulan ini</span>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Pendapatan Premium</div>
                    <div class="text-3xl font-black text-slate-800 mt-2">Rp 450Jt</div>
                    <div class="text-red-500 text-sm font-bold mt-2 flex items-center">
                        <span>▼ 1.2%</span> <span class="text-slate-400 ml-1">bulan ini</span>
                    </div>
                </div>
            </div>

            {{-- Baris 2: Grafik Dummy (Hanya Visual CSS agar terlihat seperti grafik) --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 mb-8">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-slate-700">Grafik Pertumbuhan User</h3>
                    <div class="h-8 w-32 bg-slate-100 rounded-lg"></div>
                </div>
                <div class="p-6 h-64 flex items-end justify-between gap-2 px-10 pb-0">
                    {{-- Batang-batang grafik palsu --}}
                    <div class="w-full bg-indigo-100 rounded-t-lg h-[40%]"></div>
                    <div class="w-full bg-indigo-200 rounded-t-lg h-[60%]"></div>
                    <div class="w-full bg-indigo-300 rounded-t-lg h-[50%]"></div>
                    <div class="w-full bg-indigo-400 rounded-t-lg h-[75%]"></div>
                    <div class="w-full bg-indigo-500 rounded-t-lg h-[90%]"></div>
                    <div class="w-full bg-indigo-600 rounded-t-lg h-[65%]"></div>
                    <div class="w-full bg-indigo-700 rounded-t-lg h-[85%]"></div>
                </div>
            </div>

            {{-- Baris 3: Tabel Dummy --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-bold text-lg text-slate-700">Aktivitas Terbaru</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                            <div class="flex items-center justify-between py-2 border-b border-slate-50 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-slate-200"></div>
                                <div>
                                    <div class="h-4 w-32 bg-slate-200 rounded mb-1"></div>
                                    <div class="h-3 w-20 bg-slate-100 rounded"></div>
                                </div>
                            </div>
                            <div class="h-6 w-24 bg-slate-100 rounded-full"></div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    {{-- ======================================================================== --}}
    {{-- LAYER 2: PESAN KHUSUS UNTUK REVIEWER/HRD --}}
    {{-- ======================================================================== --}}
    <div class="absolute inset-0 z-10 flex items-center justify-center p-4">
        {{-- Card Overlay --}}
        <div class="max-w-lg w-full bg-white/95 backdrop-blur-xl border border-indigo-100 shadow-2xl shadow-indigo-500/20 rounded-[2rem] p-10 text-center transform hover:scale-[1.02] transition-transform duration-300">

            {{-- Icon: Handshake / Briefcase (Simbol Kerjasama) --}}
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-full flex items-center justify-center mb-6 ring-8 ring-white shadow-inner">
                <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            {{-- Heading --}}
            <h3 class="text-2xl font-black text-slate-800 mb-3">
                Akses Fitur Terkunci 🔐
            </h3>

            {{-- Pesan "Jokes" yang Sopan --}}
            <div class="space-y-4 mb-8">
                <p class="text-slate-600 text-lg leading-relaxed">
                    Mohon maaf, halaman statistik ini belum dapat ditampilkan secara penuh.
                </p>
                <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                    <p class="text-indigo-800 font-medium">
                        "Jika Bapak/Ibu ingin membuka fitur ini, kuncinya hanya satu: <br>
                        <span class="font-bold underline decoration-wavy decoration-indigo-400">Saya berharap bisa diterima kerja</span> setelah tahapan tes & interview ini selesai." 😊
                    </p>
                </div>
                <p class="text-sm text-slate-400 italic">
                    (Semoga hasilnya memuaskan ya, Pak/Bu!)
                </p>
            </div>

            {{-- Action Button --}}
            <div class="flex flex-col gap-3">
                {{-- Tombol Utama --}}
                <button type="button" class="w-full py-4 px-6 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl shadow-lg transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    Luluskan Kandidat Ini
                </button>

                {{-- Tombol Sekunder (Opsional) --}}
                <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-slate-600 text-sm font-semibold py-2">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>