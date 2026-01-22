<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="bg-primary-100 p-2 rounded-lg">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Pengaturan Akun') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                
                <div class="p-8 bg-white shadow-xl rounded-3xl border border-slate-100 relative overflow-hidden">
                   
                    <div class="absolute top-0 left-0 w-full h-1 bg-primary-500"></div>

                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Informasi Pribadi</h3>
                    </div>

                    <div class="w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                
                <div class="p-8 bg-white shadow-xl rounded-3xl border border-slate-100 relative overflow-hidden">
                   
                    <div class="absolute top-0 left-0 w-full h-1 bg-primary-500"></div>

                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Keamanan Password</h3>
                    </div>

                    <div class="w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            
            <div class="p-8 bg-white shadow-xl rounded-3xl border border-red-100 relative overflow-hidden group">
                
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 rounded-full bg-red-50 opacity-50 group-hover:scale-150 transition duration-700"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-red-700">Area Berbahaya</h3>
                            <p class="text-sm text-slate-500">Tindakan di bawah ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="w-full max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<style>

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        border-radius: 0.75rem;
        border-color: #e2e8f0;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        width: 100%;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    label {
        color: #334155;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .text-red-600 {
        font-weight: bold;
    }
</style>