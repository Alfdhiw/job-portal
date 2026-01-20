<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    public function edit()
    {
        $employer = Employer::firstOrNew(['user_id' => auth()->id()]);
        return view('employer.edit', compact('employer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url',
        ]);

        $employer = Employer::firstOrNew(['user_id' => auth()->id()]);

        $employer->name = $request->name;
        $employer->website = $request->website;
        $employer->address = $request->address;
        $employer->description = $request->description;

        if ($request->hasFile('logo')) {
            if ($employer->logo) Storage::disk('public')->delete($employer->logo);
            $employer->logo = $request->file('logo')->store('logos', 'public');
        }

        $employer->save();

        return redirect()->back()->with('success', 'Profil Perusahaan berhasil disimpan.');
    }
}
