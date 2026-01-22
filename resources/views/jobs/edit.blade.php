<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Edit Lowongan: ') }} <span class="text-indigo-600">{{ $job->title }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl rounded-3xl border border-slate-100 relative">
               
                <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('jobs.update', $job) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Informasi Dasar
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                               
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Judul Pekerjaan</label>
                                    <input type="text" name="title" value="{{ old('title', $job->title) }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" required>
                                </div>

                               
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Nama Perusahaan</label>
                                    <input type="text" name="company_name" value="{{ $employer->name }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 cursor-not-allowed" readonly>
                                </div>

                               
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Departemen</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="department" value="{{ old('department', $job->department) }}" class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" required>
                                    </div>
                                </div>

                               
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Lokasi Penempatan</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Detail Pekerjaan
                            </h3>

                            <div class="space-y-6">
                               
                                <div class="mb-6">
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Deskripsi Pekerjaan</label>

                                   
                                    <div class="prose max-w-none">
                                        <textarea name="description" id="job_editor">{{ old('description', $job->description) }}</textarea>
                                    </div>

                                    @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                               
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Gaji (Opsional)</label>
                                    <div class="relative max-w-md">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-slate-400 font-bold">Rp</span>
                                        </div>
                                        <input type="text" name="salary" value="{{ old('salary', $job->salary) }}" class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" placeholder="Contoh: 5.000.000 - 7.000.000">
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Media & Jadwal
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                               
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 border-dashed">
                                    <label class="block font-semibold text-sm text-slate-700 mb-3">Logo Perusahaan</label>

                                    @if($employer->logo)
                                    <div class="flex items-center gap-4 mb-4 bg-white p-2 rounded-lg border border-slate-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $employer->logo) }}" alt="Current Logo" class="h-14 w-14 object-cover rounded-lg">
                                        <div>
                                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Logo Saat Ini</p>
                                            <p class="text-xs text-slate-400">Hanya bisa diganti melalui portal edit perusahaan.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                               
                                <div class="space-y-4">
                                    <div>
                                        <label class="block font-semibold text-sm text-slate-700 mb-2">Tanggal Publikasi</label>
                                        <input type="date" name="published_at" value="{{ old('published_at', $job->published_at ? $job->published_at->format('Y-m-d') : '') }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" required>
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-sm text-slate-700 mb-2">Tanggal Kedaluwarsa</label>
                                        <input type="date" name="expires_at" value="{{ old('expires_at', $job->expires_at ? $job->expires_at->format('Y-m-d') : '') }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('jobs.list') }}" class="px-5 py-2.5 rounded-xl text-slate-600 font-semibold hover:bg-slate-100 hover:text-slate-800 transition">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-100 hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>