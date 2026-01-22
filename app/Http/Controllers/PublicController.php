<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    public function index()
    {
        // Tambahkan with('employer') di awal query
        $jobs = Job::with('employer')
            ->where('is_published', true)
            ->whereDate('published_at', '<=', now())
            ->whereDate('expires_at', '>=', now())
            ->latest()
            ->get(); // Atau gunakan ->paginate(10) jika lowongan sudah banyak

        return view('welcome', compact('jobs'));
    }

    public function show(Job $job)
    {
        // 1. Optimasi Database (PENTING)
        // Kita "load" relasi employer karena logo & nama perusahaan ada di sana.
        $job->load('employer');

        // 2. Validasi Lowongan (Kode Asli Anda)
        // Cek apakah published dan belum expired
        if (!$job->is_published || $job->expires_at < now()) {
            abort(404);
        }

        return view('job-detail', compact('job'));
    }

    public function apply(Request $request, Job $job)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'cv'        => 'required|mimes:pdf|max:2048',
            'ktp'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('applications/cv', 'public');
        $ktpPath = $request->file('ktp')->store('applications/ktp', 'public');

        JobApplication::create([
            'job_id'    => $job->id,
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'cv_path'   => $cvPath,
            'ktp_path'  => $ktpPath,
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim! Semoga beruntung.');
    }

    public function confirmInterview($id)
    {
        $application = JobApplication::with('job')->findOrFail($id);

        $application->status = 'confirmed';
        $application->save();

        return view('email.confirmed', compact('application'));
    }

    public function search(Request $request)
    {
        // 1. Mulai Query
        $query = Job::query();

        // 2. Filter Keyword (Judul / Posisi)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 3. Filter Gaji Minimum
        if ($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }

        // 4. Filter Kategori (Opsional, jika ada dropdown kategori di welcome)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. Eksekusi: Ambil data terbaru & Pagination
        $jobs = $query->latest()->paginate(10)->withQueryString(); // withQueryString agar filter tidak hilang saat pindah halaman

        // 6. Return ke View Public
        // Anda bisa menggunakan view 'jobs.index' yang sudah ada, atau buat view baru khusus public
        return view('welcome', compact('jobs'));
    }
}
