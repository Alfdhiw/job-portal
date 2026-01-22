<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Berhasil - KarirKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: radial-gradient(#e0e7ff 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

   
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl shadow-indigo-200/50 overflow-hidden relative transform transition-all">

       
        <div class="relative bg-gradient-to-br from-indigo-600 to-purple-700 pt-10 pb-20 px-6 text-center">

            
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full mix-blend-overlay filter blur-xl transform translate-x-10 -translate-y-10"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white rounded-full mix-blend-overlay filter blur-xl transform -translate-x-10 translate-y-10"></div>
            </div>
        </div>

       
        <div class="absolute top-28 left-1/2 transform -translate-x-1/2">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl ring-4 ring-white p-1">
                <div class="w-full h-full bg-green-500 rounded-full flex items-center justify-center text-white animate-[bounce_2s_infinite]">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>

        
        <div class="px-8 pb-10 pt-16 text-center">

            <h1 class="text-2xl font-bold text-slate-800 mb-2">Konfirmasi Diterima!</h1>
            <p class="text-slate-500 text-sm mb-8 leading-relaxed px-4">
                Terima kasih <strong>{{ $application->name }}</strong>. Kehadiran Anda untuk sesi interview telah tercatat di sistem kami.
            </p>

           
            <div class="bg-indigo-50/60 border border-indigo-100 rounded-2xl p-4 mb-8 text-left transition hover:bg-indigo-50">
                <div class="flex items-start gap-4">
                    <div class="bg-white p-2.5 rounded-xl shadow-sm border border-indigo-50 shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider mb-0.5">Posisi Dilamar</p>
                        <h3 class="font-bold text-slate-800 truncate">{{ $application->job->title }}</h3>
                        <p class="text-xs text-slate-500 truncate">{{ $application->job->company_name ?? 'Perusahaan' }}</p>
                    </div>
                </div>
            </div>

            
            <a href="/" class="group flex items-center justify-center w-full py-3.5 bg-slate-900 hover:bg-indigo-600 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-1">
                <span>Kembali ke Beranda</span>
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>

            <p class="mt-6 text-xs text-slate-400">
                Butuh bantuan? <a href="mailto:hr@karirku.com" class="text-indigo-600 font-medium hover:underline">Hubungi HRD</a>
            </p>
        </div>
    </div>

</body>

</html>