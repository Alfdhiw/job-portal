<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lowongan: ') . $job->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Action mengarah ke route update, jangan lupa kirim ID job --}}
                    <form method="POST" action="{{ route('jobs.update', $job) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Judul Pekerjaan</label>
                                <input type="text" name="title" value="{{ old('title', $job->title) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nama Perusahaan</label>
                                <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Departemen</label>
                                <input type="text" name="department" value="{{ old('department', $job->department) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Lokasi</label>
                                <input type="text" name="location" value="{{ old('location', $job->location) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Deskripsi Pekerjaan</label>
                            <textarea name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>{{ old('description', $job->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Logo Perusahaan</label>
                                @if($job->company_logo)
                                <div class="mt-2 mb-2">
                                    <p class="text-xs text-gray-500 mb-1">Logo Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Current Logo" class="h-16 w-auto rounded border p-1">
                                </div>
                                @endif
                                <input type="file" name="company_logo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 mt-1">
                                <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika tidak ingin mengubah logo.</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Gaji (Opsional)</label>
                                <input type="text" name="salary" value="{{ old('salary', $job->salary) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tanggal Publikasi</label>
                                <input type="date" name="published_at" value="{{ old('published_at', $job->published_at->format('Y-m-d')) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tanggal Kedaluwarsa</label>
                                <input type="date" name="expires_at" value="{{ old('expires_at', $job->expires_at->format('Y-m-d')) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('jobs.index') }}" class="text-gray-600 underline text-sm hover:text-gray-900">Batal</a>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Update Lowongan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>