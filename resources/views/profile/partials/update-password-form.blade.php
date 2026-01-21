<section>
    <header>
        <h2 class="text-lg font-bold text-slate-800">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password" class="block font-semibold text-sm text-slate-700 mb-2">
                {{ __('Password Saat Ini') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                autocomplete="current-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div>
            <label for="update_password_password" class="block font-semibold text-sm text-slate-700 mb-2">
                {{ __('Password Baru') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                autocomplete="new-password"
                placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="update_password_password_confirmation" class="block font-semibold text-sm text-slate-700 mb-2">
                {{ __('Konfirmasi Password Baru') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-slate-700 transition placeholder-slate-400"
                autocomplete="new-password"
                placeholder="Ulangi password baru" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Action Button & Message --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                {{ __('Simpan Password') }}
            </button>

            @if (session('status') === 'password-updated')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center gap-2 text-sm text-green-600 font-medium bg-green-50 px-3 py-1 rounded-lg border border-green-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('Berhasil disimpan.') }}
            </div>
            @endif
        </div>
    </form>
</section>