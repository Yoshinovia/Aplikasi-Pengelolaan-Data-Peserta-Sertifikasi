<?php

namespace App\Http\Controllers;

use App\Models\CertificationScheme;
use Illuminate\Http\Request;

class CertificationSchemeController extends Controller
{
    public function index()
    {
        $schemes = CertificationScheme::latest()->paginate(10);
        return view('admin.schemes.index', compact('schemes'));
    }

    public function create()
    {
        return view('admin.schemes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:certification_schemes',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CertificationScheme::create($validated);
        return redirect()->route('schemes.index')
            ->with('success', 'Certification scheme created successfully.');
    }

    public function show(CertificationScheme $scheme)
    {
        return view('admin.schemes.show', compact('scheme'));
    }

    public function edit(CertificationScheme $scheme)
    {
        return view('admin.schemes.edit', compact('scheme'));
    }

    public function update(Request $request, CertificationScheme $scheme)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:certification_schemes,code,' . $scheme->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $scheme->update($validated);
        return redirect()->route('schemes.show', $scheme)
            ->with('success', 'Certification scheme updated successfully.');
    }

    public function destroy(CertificationScheme $scheme)
    {
        $scheme->delete();
        return redirect()->route('schemes.index')
            ->with('success', 'Certification scheme deleted successfully.');
    }
}
