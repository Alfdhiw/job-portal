<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-indigo-950 leading-tight">
                {{ __('Manajemen User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- MAIN CARD --}}
            <div class="bg-white overflow-hidden shadow-2xl shadow-indigo-200/40 rounded-[2rem] border border-indigo-100 relative">

                {{-- Decorative Top Bar --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-indigo-500 to-indigo-700"></div>

                <div class="p-8 md:p-12">

                    {{-- Header Form --}}
                    <div class="flex flex-col md:flex-row md:items-center gap-6 mb-10 border-b border-slate-100 pb-8">
                        <div class="h-20 w-20 rounded-3xl bg-primary-50 border-2 border-indigo-100 flex items-center justify-center text-indigo-600 shadow-inner flex-shrink-0">
                            {{-- Icon Plus User --}}
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tight">Tambah Pengguna Baru</h3>
                            <p class="text-slate-500 mt-1">Lengkapi formulir di bawah ini untuk mendaftarkan akun baru ke dalam sistem.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('superadmin.users.store') }}" class="space-y-6">
                        @csrf

                        {{-- Section 1: Identitas --}}
                        <div class="space-y-6">
                            {{-- Nama Lengkap --}}
                            <div class="group">
                                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-bold ml-1 mb-2 uppercase text-xs tracking-wider" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                                        class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all duration-300 text-slate-700 font-semibold placeholder-slate-400"
                                        placeholder="Masukkan nama lengkap" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 ml-2" />
                            </div>

                            {{-- Email --}}
                            <div class="group">
                                <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-bold ml-1 mb-2 uppercase text-xs tracking-wider" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                        class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all duration-300 text-slate-700 font-semibold placeholder-slate-400"
                                        placeholder="contoh@email.com" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                            </div>

                            {{-- Role --}}
                            <div class="group">
                                <x-input-label for="role" :value="__('Hak Akses (Role)')" class="text-slate-700 font-bold ml-1 mb-2 uppercase text-xs tracking-wider" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <select id="role" name="role" class="block w-full pl-12 pr-10 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all duration-300 text-slate-700 font-bold appearance-none cursor-pointer">
                                        <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate (Pencari Kerja)</option>
                                        <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer (Perusahaan)</option>
                                    </select>
                                    {{-- Custom Arrow --}}
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2 ml-2" />
                            </div>
                        </div>

                        {{-- Section 2: Password (Grid) --}}
                        <div class="pt-6 border-t border-slate-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Password --}}
                                <div class="group">
                                    <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold ml-1 mb-2 uppercase text-xs tracking-wider" />
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input id="password" name="password" type="password" required
                                            class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all duration-300 text-slate-700 placeholder-slate-400"
                                            placeholder="••••••••" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-2" />
                                </div>

                                {{-- Confirm Password --}}
                                <div class="group">
                                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-bold ml-1 mb-2 uppercase text-xs tracking-wider" />
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <input id="password_confirmation" name="password_confirmation" type="password" required
                                            class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all duration-300 text-slate-700 placeholder-slate-400"
                                            placeholder="Ulangi password" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-6 mt-6 border-t border-slate-100">
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold text-lg py-4 px-8 rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-indigo-300 transition-all duration-300 transform hover:-translate-y-1 active:scale-[0.98]">
                                {{ __('Simpan User Baru') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>