<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} - Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">

    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-indigo-600 font-bold text-xl">&larr; Kembali ke List</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">

            <div class="px-4 py-5 sm:px-6 bg-indigo-50 border-b border-indigo-100 flex items-center">
                <div class="flex-shrink-0 mr-4">
                    @if($job->company_logo)
                    <img class="h-16 w-16 rounded-full object-cover border-2 border-white shadow" src="{{ asset('storage/' . $job->company_logo) }}">
                    @else
                    <div class="h-16 w-16 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-600 font-bold text-2xl">
                        {{ substr($job->company_name, 0, 1) }}
                    </div>
                    @endif
                </div>
                <div>
                    <h3 class="text-2xl leading-6 font-bold text-gray-900">{{ $job->title }}</h3>
                    <p class="mt-1 max-w-2xl text-md text-indigo-600 font-semibold">{{ $job->company_name }}</p>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Departemen</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $job->department }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $job->location }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Gaji</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $job->salary ?? 'Disembunyikan' }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Berakhir Pada</dt>
                        <dd class="mt-1 text-sm text-red-600 sm:mt-0 sm:col-span-2 font-semibold">
                            {{ $job->expires_at->format('d F Y') }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Deskripsi Pekerjaan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">
                            {{ $job->description }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="px-4 py-6 sm:px-6 bg-gray-50 border-t border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Lamar Pekerjaan Ini</h3>

                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('job.apply', $job) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <div class="mt-1">
                                <input type="text" name="full_name" id="full_name" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Upload CV (PDF)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md bg-white">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="cv" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Upload CV</span>
                                            <input id="cv" name="cv" type="file" class="sr-only" accept=".pdf" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Foto KTP</label>
                            <div class="mt-1">
                                <input type="file" name="ktp" accept="image/*" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                <p class="text-xs text-gray-500 mt-1">JPEG, PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kirim Lamaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>