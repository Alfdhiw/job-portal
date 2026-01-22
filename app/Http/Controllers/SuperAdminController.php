<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users'        => User::count(),
            'total_candidates'   => User::where('role', 'candidate')->count(),
            'total_employers'    => User::where('role', 'employer')->count(),
            'total_jobs'         => Job::count(),
            'total_applications' => JobApplication::count(),
        ];

        return view('superadmin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'super_admin')
            ->latest()
            ->paginate(10);

        return view('superadmin.users', compact('users'));
    }

    // --- FITUR TAMBAHAN: CREATE ---
    public function createUser()
    {
        return view('superadmin.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:employer,candidate'],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('superadmin.users')->with('success', 'User baru berhasil ditambahkan.');
    }

    // --- FITUR TAMBAHAN: VIEW (SHOW) ---
    public function showUser(User $user)
    {
        // Memuat relasi jika user adalah employer (punya profil perusahaan) 
        // atau candidate (punya lamaran)
        $user->load(['employer', 'jobApplications']);

        return view('superadmin.users.show', compact('user'));
    }

    // --- FITUR TAMBAHAN: EDIT ---
    public function editUser(User $user)
    {
        return view('superadmin.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role'  => ['required', 'in:employer,candidate'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
