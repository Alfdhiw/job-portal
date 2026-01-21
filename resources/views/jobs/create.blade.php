<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Buat Lowongan Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Error Message Modern --}}
            @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="bg-white overflow-hidden shadow-xl rounded-3xl border border-slate-100">

                    {{-- Section 1: Informasi Dasar --}}
                    <div class="p-8 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-indigo-900 mb-6 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm">1</span>
                            Informasi Dasar
                        </h3>

                        <div class="space-y-6">
                            {{-- Judul Pekerjaan (Full Width) --}}
                            <div>
                                <label class="block font-semibold text-sm text-slate-700 mb-2">Judul Pekerjaan <span class="text-red-500">*</span></label>
                                <input type="text" name="title" placeholder="Contoh: Senior UI/UX Designer"
                                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 placeholder-slate-400 transition" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Departemen --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Departemen <span class="text-red-500">*</span></label>
                                    <input type="text" name="department" placeholder="Contoh: Marketing, IT, HR"
                                        class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 placeholder-slate-400 transition" required>
                                </div>
                                {{-- Lokasi --}}
                                <div>
                                    <label class="block font-semibold text-sm text-slate-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="location" placeholder="Contoh: Jakarta Selatan (Hybrid)"
                                            class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 placeholder-slate-400 transition" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Gaji --}}
                            <div>
                                <label class="block font-semibold text-sm text-slate-700 mb-2">Estimasi Gaji (Opsional)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-slate-500 font-bold">Rp</span>
                                    </div>
                                    <input type="text" name="salary" placeholder="Contoh: 8.000.000 - 12.000.000"
                                        class="w-full pl-10 rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 placeholder-slate-400 transition">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Detail Deskripsi --}}
                    <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-lg font-bold text-indigo-900 mb-6 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm">2</span>
                            Deskripsi & Kualifikasi
                        </h3>
                        <div class="w-full prose max-w-none">
                            <label class="block font-semibold text-sm text-slate-700 mb-2">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                            <div class="rounded-xl overflow-hidden border border-slate-200 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500">
                                <textarea name="description" id="editor" class="w-full"></textarea>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">*Jelaskan tanggung jawab dan kualifikasi yang dibutuhkan secara rinci.</p>
                        </div>
                    </div>

                    {{-- Section 3: Jadwal --}}
                    <div class="p-8">
                        <h3 class="text-lg font-bold text-indigo-900 mb-6 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm">3</span>
                            Jadwal Penayangan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-semibold text-sm text-slate-700 mb-2">Tanggal Publikasi <span class="text-red-500">*</span></label>
                                <input type="date" name="published_at"
                                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition" required>
                            </div>
                            <div>
                                <label class="block font-semibold text-sm text-slate-700 mb-2">Berakhir Pada <span class="text-red-500">*</span></label>
                                <input type="date" name="expires_at"
                                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 text-slate-700 transition" required>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Button --}}
                    <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-slate-800 font-medium text-sm">
                            &larr; Kembali ke Dashboard
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition transform hover:-translate-y-1 focus:ring-4 focus:ring-indigo-200">
                            Simpan Lowongan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>

{{-- Script CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            placeholder: 'Tuliskan deskripsi pekerjaan, tanggung jawab, dan persyaratan di sini...'
        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    /* Styling khusus untuk konten di dalam CKEditor agar list-nya muncul rapi */
    .ck-editor__editable {
        min-height: 200px;
        padding: 1rem !important;
        border-radius: 0 0 0.75rem 0.75rem !important;
        /* Rounded bawah mengikuti container */
    }

    .ck-toolbar {
        border-radius: 0.75rem 0.75rem 0 0 !important;
        /* Rounded atas */
        border-color: #e2e8f0 !important;
        background-color: #f8fafc !important;
    }

    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: #e2e8f0 !important;
    }

    .ck.ck-editor__main>.ck-editor__editable.ck-focused {
        border-color: #6366f1 !important;
        /* Warna Indigo saat fokus */
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
    }

    /* Memastikan bullet points muncul */
    .ck-content ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .ck-content ol {
        list-style-type: decimal;
        margin-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .ck-content h2,
    .ck-content h3,
    .ck-content h4 {
        font-weight: bold;
        color: #1e1b4b;
        /* Indigo gelap */
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .ck-content p {
        margin-bottom: 1rem;
        line-height: 1.6;
    }
</style>