<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Lowongan') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ showDeleteModal: false, deleteUrl: '' }">
        <div class="max-w-7xl mx-auto">

            {{-- Card Container --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-slate-200">

                {{-- HEADER TABLE: Tombol ditaruh disini agar rapi --}}
                <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-slate-900">List Pekerjaan Aktif</h3>
                        <p class="text-sm text-slate-500">Kelola semua lowongan pekerjaan Anda di sini.</p>
                    </div>

                    {{-- TOMBOL TAMBAH (Kode dari Anda) --}}
                    @if( ! auth()->user()->hasIncompleteProfile() )

                    {{-- KONDISI 1: Button Aktif --}}
                    <a href="{{ route('jobs.create') }}"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-indigo-600 border border-transparent rounded-lg active:bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:shadow-outline-indigo">
                        + Tambah Lowongan
                    </a>
                    @else
                    {{-- KONDISI 2: Button Mati (Disabled) --}}
                    <button disabled
                        title="Anda belum melengkapi data (Nama, Logo, atau Deskripsi). Silakan lengkapi profil terlebih dahulu."
                        class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-200 border border-transparent rounded-lg cursor-not-allowed">
                        + Tambah Lowongan
                    </button>
                    @endif
                </div>

                <div class="p-6 bg-white">
                    @if($jobs->isEmpty())
                    {{-- Tampilan Kosong --}}
                    <div class="text-center py-10">
                        <div class="bg-slate-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">Belum ada lowongan</h3>
                        <p class="text-slate-500 mt-1">Silakan buat lowongan pertama Anda dengan tombol di atas.</p>
                    </div>
                    @else
                    {{-- Tabel Data --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Posisi / Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal Upload</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal Expired</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach ($jobs as $job)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">{{ $job->title ?? 'Judul Kosong' }}</div>
                                        <div class="text-xs text-slate-500">{{ $job->location ?? 'Lokasi Kosong' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $job->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $job->expires_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('jobs.edit', $job->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>

                                            {{-- TOMBOL TRIGGER MODAL --}}
                                            {{-- Saat diklik: Set URL delete sesuai ID ini, lalu buka modal --}}
                                            <button
                                                @click="showDeleteModal = true; deleteUrl = '{{ route('jobs.destroy', $job->id) }}'"
                                                class="text-red-600 hover:text-red-900 focus:outline-none">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $jobs->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div
            x-show="showDeleteModal"
            style="display: none;"
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

                {{-- 1. BACKDROP (Latar Belakang Gelap) --}}
                {{-- Efek: Tetap Fade In/Out biasa agar mata nyaman --}}
                <div
                    x-show="showDeleteModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 backdrop-blur-sm"
                    @click="showDeleteModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- 2. KOTAK MODAL (Efek FADE UP) --}}
                <div
                    x-show="showDeleteModal"
                    {{-- Animasi Masuk (Muncul dari bawah) --}}
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"

                    {{-- Animasi Keluar (Turun ke bawah) --}}
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-10"

                    class="relative inline-block w-full overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl rounded-2xl sm:my-8 sm:align-middle sm:max-w-lg">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            {{-- Ikon --}}
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>

                            {{-- Teks --}}
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Hapus Lowongan?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan lagi.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="gap-2 px-4 py-3 bg-slate-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form :action="deleteUrl" method="POST" class="inline-block w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white transition-colors bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                Ya, Hapus
                            </button>
                        </form>
                        <button type="button" @click="showDeleteModal = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium transition-colors bg-white border shadow-sm rounded-lg border-slate-300 text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>