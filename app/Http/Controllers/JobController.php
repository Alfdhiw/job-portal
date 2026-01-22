<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function index()
    {

        if (Auth::user()->role === 'candidate') {
            return redirect()->route('home');
        }

        $jobs = Job::active()
            ->latest()
            ->filter(request(['search', 'min_salary']))
            ->paginate(10)
            ->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        Gate::authorize('is-employer');

        $employer = auth()->user()->employer;

        if (auth()->user()->hasIncompleteProfile()) {
            return redirect()->route('employer.edit')
                ->with('error', 'Silakan lengkapi Nama, Logo, dan Deskripsi perusahaan sebelum memposting lowongan.');
        }

        return view('jobs.create', compact('employer'));
    }

    public function store(Request $request)
    {
        // 1. Otorisasi
        Gate::authorize('is-employer');

        // 2. Ambil Data Employer
        $employer = Auth::user()->employer;

        // Cek jika profil perusahaan belum ada
        if (!$employer) {
            return redirect()->route('employer.edit')
                ->with('error', 'Harap lengkapi profil perusahaan terlebih dahulu!');
        }

        // 3. Validasi Input
        $request->validate([
            'title'        => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'description'  => 'required', // Karena pakai WYSIWYG, stringnya bisa panjang
            'salary'       => 'nullable|string', // Tambahkan ini agar input gaji tersimpan
            'published_at' => 'required|date',
            'expires_at'   => 'required|date|after:published_at',
        ]);

        // 4. Simpan Data
        // Gunakan $employer->jobs() agar 'employer_id' terisi otomatis
        $employer->jobs()->create([
            'title'        => $request->title,
            'department'   => $request->department,
            'location'     => $request->location,
            'description'  => $request->description,
            'salary'       => $request->salary,
            'published_at' => $request->published_at,
            'expires_at'   => $request->expires_at,
            'is_published' => true,
        ]);

        return redirect()->route('jobs.list')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Job $job)
    {
        Gate::authorize('update', $job);

        $employer = auth()->user()->employer;

        return view('jobs.edit', compact('employer', 'job'));
    }

    public function update(Request $request, Job $job)
    {
        Gate::authorize('update', $job);

        $validatedData = $request->validate([
            'title'        => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'description'  => 'required',
            'published_at' => 'required|date',
            'expires_at'   => 'required|date|after:published_at',
            'salary'       => 'nullable|string',
        ]);

        // Update data job yang sedang diedit
        $job->update($validatedData);

        return redirect()->route('jobs.list')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(Job $job)
    {
        Gate::authorize('delete', $job);

        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        return redirect()->route('jobs.list')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function list()
    {
        $jobs = Job::where('created_by_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('jobs.list', compact('jobs'));
    }

    public function statistik()
    {
        return view('statistik.statistik');
    }
}
