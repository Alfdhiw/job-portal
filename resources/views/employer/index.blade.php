<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kandidat Pelamar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-slate-200">

                <div class="px-6 py-5 border-b border-slate-200">
                    <h3 class="text-lg font-medium text-slate-900">Daftar Lamaran Masuk</h3>
                    <p class="text-sm text-slate-500">Review kandidat yang melamar ke lowongan Anda.</p>
                </div>

                <div class="p-6 bg-white">
                    @if($applications->isEmpty())
                    <div class="text-center py-12">
                        <div class="bg-indigo-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">Belum ada kandidat</h3>
                        <p class="text-slate-500 mt-1">Saat ini belum ada pelamar yang masuk.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kandidat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Posisi Dilamar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">CV / Resume</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach ($applications as $app)
                                <tr class="hover:bg-slate-50 transition-colors">

                                    {{-- 1. KOLOM KANDIDAT (Ambil langsung dari tabel applications) --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                {{-- Buat inisial dari nama pelamar --}}
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                                    {{ substr($app->name ?? 'Guest', 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                {{-- Sesuaikan 'name' dan 'email' dengan nama kolom database Anda --}}
                                                <div class="text-sm font-medium text-slate-900">{{ $app->name }}</div>
                                                <div class="text-xs text-slate-500">{{ $app->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-900 font-medium">{{ $app->job->title }}</div>
                                        <div class="text-xs text-slate-500">{{ $app->job->type ?? 'Full Time' }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $app->created_at->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        @if($app->resume_path)
                                        <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Lihat CV
                                        </a>
                                        @else
                                        <span class="text-slate-400 italic">Tidak ada CV</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                        $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'interview' => 'bg-blue-100 text-blue-800',
                                        'accepted' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        ];
                                        // Default ke pending jika kolom status kosong
                                        $statusClass = $statusClasses[$app->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($app->status ?? 'pending') }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>