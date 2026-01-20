<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">

    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-indigo-600">JobPortal</h1>
                </div>
                <div class="flex items-center">
                    @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                        <a href="{{ url('/jobs') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Login Staff</a>
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Temukan Pekerjaan Impianmu
            </h2>
            <p class="mt-4 text-xl text-gray-500">
                Lowongan terbaru dari perusahaan terkemuka.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($jobs as $job)
            <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition duration-300 border border-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if($job->company_logo)
                            <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->company_name }}">
                            @else
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold text-xl">
                                {{ substr($job->company_name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <a href="{{ route('job.show', $job) }}" class="hover:underline">{{ $job->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500">{{ $job->company_name }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $job->department }}
                        </span>
                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                            {{ Str::limit($job->description, 100) }}
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between items-center text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $job->location }}
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <a href="{{ route('job.show', $job) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 w-full text-center block">
                        Lihat Detail &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada lowongan pekerjaan yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white mt-12 py-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} JobPortal App. All rights reserved.
        </div>
    </footer>
</body>

</html>