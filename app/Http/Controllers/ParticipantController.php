<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\CertificationScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::with('certificationScheme');
        
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('certification_scheme_code')) {
            $query->where('certification_scheme_code', $request->certification_scheme_code);
        }
        
        $participants = $query->latest()->paginate(10);
        $schemes = CertificationScheme::all();
        
        return view('admin.participants.index', compact('participants', 'schemes'));
    }

    public function create()
    {
        $schemes = CertificationScheme::all();
        return view('admin.participants.create', compact('schemes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants',
            'phone' => 'nullable|string|max:20',
            'certification_scheme_code' => 'required|exists:certification_schemes,code',
        ]);

        Participant::create($validated);
        return redirect()->route('participants.index')
            ->with('success', 'Participant created successfully.');
    }

    public function show(Participant $participant)
    {
        $participant->load('certificationScheme');
        return view('admin.participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        $schemes = CertificationScheme::all();
        return view('admin.participants.edit', compact('participant', 'schemes'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email,' . $participant->id,
            'phone' => 'nullable|string|max:20',
            'certification_scheme_code' => 'required|exists:certification_schemes,code',
        ]);

        $participant->update($validated);
        return redirect()->route('participants.show', $participant)
            ->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')
            ->with('success', 'Participant deleted successfully.');
    }
}
