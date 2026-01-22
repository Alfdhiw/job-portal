<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Super Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50"> {{-- Pastikan bg sedikit gelap agar putih kontras --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Bagian Atas: Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Card 1: Total Users --}}
                <div class="relative bg-white p-6 rounded-xl shadow-md border-l-4 border-slate-600 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Users</div>
                            <div class="text-3xl font-extrabold text-slate-800">{{ $stats['total_users'] }}</div>
                            <div class="text-xs text-slate-400 mt-1">Akun terdaftar</div>
                        </div>
                    </div>
                    {{-- Decorative Icon --}}
                    <div class="absolute right-4 top-4 opacity-10 text-slate-800">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Card 2: Perusahaan --}}
                <div class="relative bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <div class="text-indigo-500 text-xs font-bold uppercase tracking-wider mb-1">Perusahaan</div>
                            <div class="text-3xl font-extrabold text-indigo-700">{{ $stats['total_employers'] }}</div>
                            <div class="text-xs text-indigo-300 mt-1">Mitra Aktif</div>
                        </div>
                    </div>
                    {{-- Decorative Icon --}}
                    <div class="absolute right-4 top-4 opacity-10 text-indigo-600">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

                {{-- Card 3: Lowongan --}}
                <div class="relative bg-white p-6 rounded-xl shadow-md border-l-4 border-emerald-500 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <div class="text-emerald-500 text-xs font-bold uppercase tracking-wider mb-1">Lowongan Aktif</div>
                            <div class="text-3xl font-extrabold text-emerald-700">{{ $stats['total_jobs'] }}</div>
                            <div class="text-xs text-emerald-300 mt-1">Siap dilamar</div>
                        </div>
                    </div>
                    {{-- Decorative Icon --}}
                    <div class="absolute right-4 top-4 opacity-10 text-emerald-600">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Card 4: Lamaran --}}
                <div class="relative bg-white p-6 rounded-xl shadow-md border-l-4 border-amber-500 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <div class="text-amber-500 text-xs font-bold uppercase tracking-wider mb-1">Total Lamaran</div>
                            <div class="text-3xl font-extrabold text-amber-700">{{ $stats['total_applications'] }}</div>
                            <div class="text-xs text-amber-300 mt-1">Semua status</div>
                        </div>
                    </div>
                    {{-- Decorative Icon --}}
                    <div class="absolute right-4 top-4 opacity-10 text-amber-600">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>

            </div>

            {{-- Bagian Bawah: Shortcut Menu --}}
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-slate-200">
                <div class="p-6 bg-white border-b border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="p-6 bg-slate-50/50">
                    <div class="flex gap-4">
                        <a href="{{ route('superadmin.users') }}" class="inline-flex items-center px-6 py-4 bg-violet-600 text-white rounded-xl shadow-lg hover:bg-violet-500 hover:shadow-xl transition transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="font-semibold">Kelola Semua User</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>