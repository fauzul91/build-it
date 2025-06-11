<?php

namespace App\Http\Controllers;

use App\Models\TutorVerif;
use App\Models\User;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        return view('landing.jadi-tutor');
    }
    public function verif()
    {
        return view('auth.tutor-verification');
    }
    public function activeTutors(Request $request)
    {
        $tutors = TutorVerif::where('status', 'approved')->get();    

        return view('tutor.active', compact('tutors'));
    }
    public function pendingTutors(Request $request)
    {
        $tutors = TutorVerif::where('status', 'pending')->get();    

        return view('tutor.pending', compact('tutors'));
    }
    public function approve(Request $request, $id)
    {
        $tutorVerif = TutorVerif::findOrFail($id);
        $tutorVerif->update(['status' => 'approved']);

        return redirect()->route('tutor.active')->with('success', 'Tutor berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $tutor = TutorVerif::findOrFail($id);
        $tutor->rejection_reason = $request->rejection_reason;
        $tutor->status = 'rejected';
        $tutor->save();

        return redirect()->route('tutor.pending')->with('success', 'Tutor berhasil ditolak.');
    }

    public function verifStore(Request $request)
    {
        $request->validate([
            'portofolio' => 'required|file|mimes:pdf,doc,docx|max:81920',
            'linkedin_url' => 'required|url',
            'github_url' => 'nullable|url',
        ]);

        auth()->user()->tutorVerif()->updateOrCreate(
            ['tutor_id' => auth()->id()],
            [
                'portofolio' => $request->file('portofolio')->store('portofolio', 'public'),
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'status' => 'pending',
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Verifikasi tutor berhasil, tunggu konfirmasi admin.');
    }
}