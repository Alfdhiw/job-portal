<x-app-layout>
    {{-- Header Background --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 pb-32 pt-12 rounded-3xl shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    {{-- Breadcrumb --}}
                    <a href="{{ route('employer.candidates') }}" class="flex items-center text-indigo-100 hover:text-white mb-4 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="text-3xl font-bold text-white tracking-tight">{{ $application->name }}</h1>
                    <p class="text-indigo-100 mt-1 flex items-center gap-2">
                        Melamar untuk posisi <span class="font-semibold bg-white/20 px-2 py-0.5 rounded text-white">{{ $application->job->title }}</span>
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-3 rounded-2xl">
                    <p class="text-xs text-indigo-100 uppercase tracking-wider font-semibold mb-1">Status Lamaran</p>
                    @php
                    $statusColors = [
                    'pending' => 'text-yellow-300',
                    'interview' => 'text-blue-300',
                    'confirmed' => 'text-green-300',
                    ];
                    $color = $statusColors[$application->status] ?? 'text-gray-300';
                    @endphp
                    <span class="text-2xl font-bold {{ $color }} capitalize">
                        {{ $application->status ?? 'Pending' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: Informasi Utama & Dokumen --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card 1: Quick Actions (Tombol Aksi) --}}
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Proses Lamaran</h3>
                    <div class="flex flex-wrap gap-3">
                        {{-- Bungkus area ini dengan Alpine x-data --}}
                        <div x-data="{ showModal: false }">

                            {{-- 1. TOMBOL TRIGGER (Yang sudah ada, dimodifikasi sedikit) --}}
                            <div class="flex items-center">
                                {{-- STATUS: PENDING (Tombol Aktif) --}}
                                @if($application->status == 'pending')
                                <button
                                    @click="showModal = true"
                                    type="button"
                                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium text-sm transition shadow-lg shadow-indigo-600/30 flex items-center gap-2 transform active:scale-95">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Jadwalkan Interview
                                </button>

                                {{-- STATUS: INTERVIEW (Menunggu Kandidat) --}}
                                @elseif($application->status == 'interview')
                                <div class="px-5 py-2.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-xl font-medium text-sm flex items-center gap-2 cursor-default">
                                    <svg class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Menunggu Konfirmasi</span>
                                </div>

                                {{-- STATUS: CONFIRMED (Sudah Oke) --}}
                                @elseif($application->status == 'confirmed')
                                <div class="px-5 py-2.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl font-medium text-sm flex items-center gap-2 cursor-default">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Interview Terkonfirmasi</span>
                                </div>
                                @endif
                            </div>

                            {{-- 2. MODAL POP-UP (Overlay & Content) --}}
                            <div
                                x-show="showModal"
                                style="display: none;"
                                class="fixed inset-0 z-50 overflow-y-auto"
                                aria-labelledby="modal-title"
                                role="dialog"
                                aria-modal="true">
                                {{-- Background Backdrop (Gelap & Fade effect) --}}
                                <div
                                    x-show="showModal"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity"
                                    @click="showModal = false"></div>

                                {{-- Modal Panel (Tengah Layar) --}}
                                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                    <div
                                        x-show="showModal"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-indigo-100">

                                        {{-- Form Mulai --}}
                                        <form action="{{ route('employer.store', $application->id) }}" method="POST">
                                            @csrf

                                            {{-- Header Modal --}}
                                            <div class="bg-indigo-600 px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <h3 class="text-lg font-bold leading-6 text-white flex items-center gap-2" id="modal-title">
                                                        <svg class="w-5 h-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        Undangan Interview
                                                    </h3>
                                                    <button type="button" @click="showModal = false" class="text-indigo-200 hover:text-white transition">
                                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <p class="mt-1 text-sm text-indigo-100">Kirim detail jadwal interview ke email kandidat.</p>
                                            </div>

                                            {{-- Body Modal --}}
                                            <div class="px-4 py-6 sm:p-6 space-y-5">

                                                {{-- Input Tanggal --}}
                                                <div>
                                                    <label for="interview_date" class="block text-sm font-semibold text-slate-700">Tanggal & Waktu</label>
                                                    <input type="datetime-local" name="interview_date" id="interview_date" required
                                                        class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 border bg-slate-50">
                                                </div>

                                                {{-- Input Pesan Tambahan --}}
                                                <div>
                                                    <label for="message" class="block text-sm font-semibold text-slate-700">Pesan Undangan</label>
                                                    <div class="mt-1">
                                                        <textarea id="message" name="message" rows="4" required
                                                            class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 border bg-slate-50"
                                                            placeholder="Halo, kami mengundang Anda untuk interview di kantor kami pada..."></textarea>
                                                    </div>
                                                    <p class="mt-2 text-xs text-slate-500">Email ini akan otomatis dikirim ke <span class="font-medium text-slate-700">{{ $application->email }}</span>.</p>
                                                </div>
                                            </div>

                                            {{-- Footer Modal --}}
                                            <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-100">
                                                <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition hover:shadow-lg shadow-indigo-600/30">
                                                    Kirim Undangan
                                                </button>
                                                <button type="button" @click="showModal = false" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: CV / Resume Preview --}}
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-slate-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Dokumen CV
                        </h3>
                        @if($application->resume_path || $application->cv_path)
                        {{-- Perbaikan Link CV sesuai diskusi sebelumnya --}}
                        @php
                        $path = $application->resume_path ?? $application->cv_path;
                        // Bersihkan path jika perlu
                        $url = asset('storage/' . $path);
                        @endphp
                        <a href="{{ $url }}" target="_blank" class="text-sm font-semibold text-indigo-600 hover:underline">Download PDF</a>
                        @endif
                    </div>

                    <div class="bg-slate-50 rounded-xl border border-slate-200 p-8 text-center">
                        @if($application->resume_path || $application->cv_path)
                        <div class="mx-auto w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-slate-900 font-medium text-lg">File CV Tersedia</p>
                        <p class="text-slate-500 text-sm mb-6">Klik tombol di bawah untuk melihat detail.</p>
                        <a href="{{ $url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-indigo-600 transition shadow-lg hover:shadow-indigo-600/30">
                            Buka CV (PDF)
                        </a>
                        @else
                        <p class="text-slate-400 italic">Kandidat tidak mengunggah CV.</p>
                        @endif
                    </div>
                </div>

                {{-- Card 3: Foto KTP (Jika ada) --}}
                @if(isset($application->ktp_path) || isset($application->ktp))
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        Identitas (KTP)
                    </h3>
                    <div class="overflow-hidden rounded-xl border border-slate-200">
                        @php $ktpPath = $application->ktp_path ?? $application->ktp; @endphp
                        <img src="{{ asset('storage/' . $ktpPath) }}" alt="KTP" class="w-full h-auto object-cover hover:scale-105 transition duration-500">
                    </div>
                </div>
                @endif
            </div>

            {{-- KOLOM KANAN: Sidebar Info --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Card Kontak --}}
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Informasi Kontak</h3>

                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs text-slate-500 font-medium">Nama Lengkap</p>
                            <p class="text-slate-900 font-semibold truncate">{{ $application->full_name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="overflow-hidden w-full">
                            <p class="text-xs text-slate-500 font-medium">Email</p>
                            <p class="text-slate-900 font-semibold break-all">{{ $application->email }}</p>
                            <a href="mailto:{{ $application->email }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium mt-1 inline-block">Kirim Email</a>
                        </div>
                    </div>
                </div>

                {{-- Card Meta Data --}}
                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Meta Data</h3>

                    <ul class="space-y-4">
                        <li class="flex justify-between items-center text-sm border-b border-slate-50 pb-3">
                            <span class="text-slate-500">Tanggal Melamar</span>
                            <span class="font-medium text-slate-900">{{ $application->created_at->format('d M Y, H:i') }}</span>
                        </li>
                        <li class="flex justify-between items-center text-sm">
                            <span class="text-slate-500">Lowongan ID</span>
                            <span class="font-mono text-slate-500 bg-slate-100 px-2 py-1 rounded">#{{ $application->job->id }}</span>
                        </li>
                    </ul>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <p class="text-xs text-slate-400 mb-2">Pekerjaan yang dilamar:</p>
                        <a href="#" class="block group">
                            <h4 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">{{ $application->job->title }}</h4>
                            <p class="text-xs text-slate-500 mt-1 truncate">{{ $application->job->type ?? 'Full Time' }} • {{ $application->job->location ?? 'Remote' }}</p>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>