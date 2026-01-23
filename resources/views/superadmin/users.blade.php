<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Daftar Pengguna</h3>
                    <p class="text-slate-500 text-sm mt-1">Kelola hak akses dan informasi seluruh pengguna sistem.</p>
                </div>
                <a href="{{ route('superadmin.users.create') }}" class="inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-2xl transition-all shadow-lg shadow-primary-200 group">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah User Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-slate-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 font-semibold tracking-wider">Informasi User</th>
                                <th class="px-6 py-5 font-semibold tracking-wider text-center">Role Akses</th>
                                <th class="px-6 py-5 font-semibold tracking-wider">Tanggal Bergabung</th>
                                <th class="px-6 py-5 font-semibold tracking-wider text-right">Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($users as $user)
                            <tr class="hover:bg-primary-50/30 transition-colors duration-200">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        {{-- Avatar Inisial --}}
                                        <div class="h-11 w-11 rounded-full bg-primary-100 border border-primary-200 flex items-center justify-center shrink-0">
                                            <span class="text-primary-700 font-bold text-sm">
                                                {{ substr($user->name, 0, 2) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 text-base">{{ $user->name }}</div>
                                            <div class="text-slate-500 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if($user->role == 'employer')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span>
                                        Perusahaan
                                    </span>
                                    @elseif($user->role == 'superadmin')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2"></span>
                                        Superadmin
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-2"></span>
                                        Kandidat
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-slate-700 font-medium">{{ $user->created_at->translatedFormat('d M Y') }}</div>
                                    <div class="text-xs text-slate-400">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('superadmin.users.edit', $user->id) }}" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all" title="Edit User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <button
                                            type="button"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion'); $dispatch('set-delete-action', '{{ route('superadmin.users.destroy', $user->id) }}')"
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                            title="Hapus User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
                @if($users->hasPages())
                <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    
    <x-modal name="confirm-user-deletion" focusable>
        <div x-data="{ actionUrl: '' }" @set-delete-action.window="actionUrl = $event.detail">
            <form method="post" :action="actionUrl" class="p-0 overflow-hidden rounded-2xl bg-white text-left">
                @csrf
                @method('delete')
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 h-12 w-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Hapus Pengguna?</h2>
                    </div>
                    <p class="text-slate-500 leading-relaxed">
                        Tindakan ini tidak dapat dibatalkan. Seluruh data yang terkait dengan pengguna ini akan dihapus secara permanen dari server kami.
                    </p>
                </div>
                <div class="bg-slate-50 px-8 py-4 flex flex-row-reverse gap-3 border-t border-slate-100">
                    <button type="submit" class="inline-flex justify-center rounded-xl bg-red-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-red-100 hover:bg-red-700 transition-all">
                        Ya, Hapus Sekarang
                    </button>
                    <button type="button" x-on:click="$dispatch('close')" class="inline-flex justify-center rounded-xl border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-all">
                        Batalkan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>