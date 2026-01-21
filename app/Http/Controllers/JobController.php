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

        return view('jobs.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('is-employer');

        $employer = Auth::user()->employer;

        if (!$employer) {
            return redirect()->route('employer.edit')->with('error', 'Harap lengkapi profil perusahaan terlebih dahulu!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required',
            'published_at' => 'required|date',
            'expires_at' => 'required|date|after:published_at',
        ]);

        $logoPath = null;
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
        }

        Auth::user()->jobs()->create([
            'title' => $request->title,
            'company_name' => $employer->name,
            'company_logo' => $employer->logo,
            'department' => $request->department,
            'location' => $request->location,
            'description' => $request->description,
            'company_logo' => $logoPath,
            'published_at' => $request->published_at,
            'expires_at' => $request->expires_at,
            'salary' => $request->salary,
            'is_published' => true,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Job $job)
    {
        Gate::authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        Gate::authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date',
            'expires_at' => 'required|date|after:published_at',
            'salary' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }
            $validatedData['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

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
}
