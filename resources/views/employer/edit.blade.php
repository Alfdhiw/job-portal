<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Perusahaan Anda</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Data ini akan otomatis digunakan setiap kali Anda memposting lowongan pekerjaan baru.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('employer.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Nama Perusahaan / PT <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $employer->name) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required placeholder="Contoh: PT. Mencari Cinta Sejati">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Logo Perusahaan</label>

                            @if($employer->logo)
                            <div class="mt-2 mb-3 flex items-center">
                                <img src="{{ asset('storage/' . $employer->logo) }}" alt="Current Logo" class="h-20 w-20 object-contain rounded border p-1 bg-gray-50">
                                <span class="ml-3 text-sm text-gray-500">Logo saat ini</span>
                            </div>
                            @endif

                            <input type="file" name="logo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 mt-1">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                            @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Website Resmi (Opsional)</label>
                            <input type="url" name="website" value="{{ old('website', $employer->website) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" placeholder="https://perusahaan.com">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Alamat Kantor</label>
                            <textarea name="address" rows="2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">{{ old('address', $employer->address) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Deskripsi Singkat Perusahaan</label>
                            <textarea name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" placeholder="Bergerak di bidang apa?">{{ old('description', $employer->description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-indigo-600 text-black px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                                Simpan Profil
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>