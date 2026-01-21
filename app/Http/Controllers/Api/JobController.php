<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $query = Job::query();

        $query->where('is_published', true)
            ->whereDate('expires_at', '>', now());

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('company_name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }

        $jobs = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List of Available Jobs',
            'data'    => $jobs
        ], 200);
    }

    public function apply(Request $request, $id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'cv'        => 'required|file|mimes:pdf|max:2048',
            'ktp'       => 'required|file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $cvPath = $request->file('cv')->store('applications/cv', 'public');
            $ktpPath = $request->file('ktp')->store('applications/ktp', 'public');

            JobApplication::create([
                'job_id'    => $job->id,
                'full_name' => $request->full_name,
                'email'     => $request->email,
                'cv_path'   => $cvPath,
                'ktp_path'  => $ktpPath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong on server',
            ], 500);
        }
    }
}
