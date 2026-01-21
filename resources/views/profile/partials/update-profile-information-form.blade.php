<section>
    <header>
        <h2 class="text-lg font-bold text-slate-800">
            {{ __('Informasi Profil Akun') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __("Perbarui nama profil dan alamat email akun Anda.") }}
        </p>
    </header>

    {{-- Form Verifikasi (Hidden Logic) --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        {{-- Input Nama --}}
        <div>
            <label for="name" class="block font-semibold text-sm text-slate-700 mb-2">
                {{ __('Nama Lengkap') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Input Email --}}
        <div>
            <label for="email" class="block font-semibold text-sm text-slate-700 mb-2">
                {{ __('Alamat Email') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- Logic: Jika Email Belum Diverifikasi --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ __('Alamat email Anda belum diverifikasi.') }}
                        </p>
                        <button form="send-verification" class="mt-2 text-sm font-bold text-yellow-700 underline hover:text-yellow-600 focus:outline-none">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                <div class="mt-3 text-sm font-medium text-green-600">
                    {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                {{ __('Simpan Profil') }}
            </button>

            @if (session('status') === 'profile-updated')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center gap-2 text-sm text-green-600 font-medium bg-green-50 px-3 py-1 rounded-lg border border-green-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('Data berhasil disimpan.') }}
            </div>
            @endif
        </div>
    </form>
</section>