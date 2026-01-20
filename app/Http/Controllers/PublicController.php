<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    public function index()
    {
        $jobs = Job::where('is_published', true)
            ->whereDate('published_at', '<=', now())
            ->whereDate('expires_at', '>=', now())
            ->latest()
            ->get();

        return view('welcome', compact('jobs'));
    }

    public function show(Job $job)
    {

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
}
