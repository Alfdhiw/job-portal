<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Profil Perusahaan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message Success --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm flex items-start gap-3 transition duration-500">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-green-800">Berhasil!</h3>
                    <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Flash Message Error --}}
            @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-start gap-3">
                <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Gagal!</h3>
                    <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('employer.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="bg-white overflow-hidden shadow-xl rounded-3xl border border-slate-100 relative">
                    {{-- Dekorasi Atas --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500"></div>

                    {{-- Header Section --}}
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Informasi Publik</h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Data ini akan ditampilkan pada setiap lowongan pekerjaan Anda.
                            </p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                            {{-- KOLOM KIRI: Upload Logo --}}
                            <div class="md:col-span-1 space-y-4">
                                <label class="block font-bold text-sm text-slate-700">Logo Perusahaan</label>

                                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 border-dashed text-center">
                                    {{-- Preview Logic --}}
                                    @if($employer->logo)
                                    <div class="mx-auto h-32 w-32 bg-white p-2 rounded-xl shadow-sm border border-slate-100 mb-4 flex items-center justify-center relative group overflow-hidden">
                                        <img src="{{ asset('storage/' . $employer->logo) }}" alt="Current Logo" class="max-h-full max-w-full object-contain">
                                    </div>
                                    <p class="text-xs font-semibold text-slate-500 mb-2">Logo Saat Ini</p>
                                    @else
                                    <div class="mx-auto h-32 w-32 bg-indigo-50 rounded-xl flex items-center justify-center mb-4 text-indigo-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-slate-400 mb-2">Belum ada logo</p>
                                    @endif

                                    {{-- File Input --}}
                                    <input type="file" name="logo" class="block w-full text-xs text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-xs file:font-bold
                                        file:bg-indigo-100 file:text-indigo-700
                                        hover:file:bg-indigo-200
                                        cursor-pointer transition
                                    " />
                                    <p class="text-[10px] text-slate-400 mt-2">Format: JPG/PNG, Max 2MB</p>
                                    @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- KOLOM KANAN: Form Input --}}
                            <div class="md:col-span-2 space-y-6">
                                {{-- Nama Perusahaan --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $employer->name) }}"
                                        class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                                        placeholder="Contoh: PT. Maju Bersama" required>
                                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                {{-- Website --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Website Resmi</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                            </svg>
                                        </div>
                                        <input type="url" name="website" value="{{ old('website', $employer->website) }}"
                                            class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                                            placeholder="https://perusahaan.com">
                                    </div>
                                    @error('website') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                {{-- Alamat --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Alamat Kantor</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <textarea name="address" rows="2"
                                            class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                                            placeholder="Alamat lengkap kantor pusat...">{{ old('address', $employer->address) }}</textarea>
                                    </div>
                                </div>

                                {{-- Deskripsi --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Tentang Perusahaan</label>
                                    <textarea name="description" rows="5"
                                        class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                                        placeholder="Jelaskan visi misi, budaya kerja, atau bidang industri perusahaan Anda...">{{ old('description', $employer->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-4">
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl text-slate-600 font-semibold hover:bg-slate-200 hover:text-slate-800 transition text-sm">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-100 transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>