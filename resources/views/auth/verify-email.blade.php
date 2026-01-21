<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-4 animate-pulse">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-900">Verifikasi Email</h2>
        <p class="text-slate-500 text-sm mt-3 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan?
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="text-sm font-medium text-green-700">
            Link verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran.
        </div>
    </div>
    @endif

    <div class="flex flex-col gap-4 mt-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition underline decoration-slate-300 underline-offset-4">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>