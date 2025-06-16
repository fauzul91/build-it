<?php

namespace App\Http\Controllers;

use App\Models\TutorVerif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function tutorDashboard()
    {
        $user = auth()->user();
        $verif = TutorVerif::where('tutor_id', $user->id)->first();

        return view('dashboard.tutor', compact('verif'));
    }
    public function adminDashboard()
    {    
        return view('dashboard.admin');
    }
}
