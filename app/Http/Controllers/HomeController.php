<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.home');
    }
    public function course()
    {
        $courses = Course::all();
        $userId = auth()->id();

        $isPurchased = Transaction::where('user_id', $userId)
            ->where('status', 'completed')
            ->pluck('course_id')
            ->toArray();
        return view('landing.course', compact('courses', 'isPurchased'));
    }
    public function jadiTutor()
    {
        return view('landing.tutor');
    }
    public function detail($slug)
    {
        $course = Course::with('tutor', 'videos')->where('slug', $slug)->first(); 
        return view('landing.detail', compact('course'));
    }
}