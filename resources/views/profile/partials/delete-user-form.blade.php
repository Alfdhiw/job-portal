<section class="space-y-6">
    <header>
        {{-- Judul Section --}}
        <h2 class="text-lg font-bold text-slate-800">
            {{ __('Hapus Akun Permanen') }}
        </h2>

        {{-- Deskripsi --}}
        <p class="mt-1 text-sm text-slate-500 leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan data yang terkait akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan sebagai cadangan.') }}
        </p>
    </header>

    {{-- Tombol Trigger Merah --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-5 py-2.5 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-red-100 transform hover:-translate-y-0.5">
        {{ __('Hapus Akun Saya') }}
    </button>

    {{-- MODAL KONFIRMASI --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-0 overflow-hidden rounded-2xl">
            @csrf
            @method('delete')

            <div class="p-6">
                {{-- Header Modal dengan Icon Peringatan --}}
                <div class="flex items-start gap-4 mb-5">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-red-100 flex items-center justify-center sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            {{ __('Apakah Anda yakin ingin menghapus akun?') }}
                        </h2>
                        <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                            {{ __('Akun yang dihapus tidak dapat dipulihkan kembali. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
                        </p>
                    </div>
                </div>

                {{-- Input Password --}}
                <div class="mt-6 ml-0 sm:ml-14">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-red-500 focus:ring-red-500 py-3 px-4 text-slate-700 placeholder-slate-400"
                            placeholder="{{ __('Masukkan Password Anda') }}" />
                    </div>

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 ml-1" />
                </div>
            </div>

            {{-- Footer / Action Buttons --}}
            <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-slate-100">
                <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent bg-red-600 px-4 py-2 text-base font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:text-sm sm:w-auto">
                    {{ __('Ya, Hapus Akun') }}
                </button>

                <button type="button" x-on:click="$dispatch('close')" class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-base font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                    {{ __('Batal') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>