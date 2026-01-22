<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CandidateProfileController extends Controller
{

    /**
     * Tampilkan form edit profil.
     */
    public function edit()
    {
        if (auth()->user()->role !== 'candidate') {
            abort(403, 'Halaman ini khusus untuk Kandidat Pelamar Kerja.');
        }
        $user = auth()->user();
        return view('candidate.profile', compact('user'));
    }

    /**
     * Proses update data user.
     */
    public function update(Request $request)
    {
        if (auth()->user()->role !== 'candidate') {
            abort(403, 'Akses ditolak.');
        }
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        // 1. Cek Keamanan
        if (auth()->user()->role !== 'candidate') {
            abort(403);
        }

        // 2. Validasi
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'], // Fitur bawaan Laravel utk cek password lama
            'password' => ['required', 'confirmed', Password::defaults()], // Password baru + konfirmasi
        ]);

        // 3. Update Password
        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
