<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        return view('landing.course', compact('courses'));
    }
        public function jadiTutor()
    {
        return view('landing.tutor');
    }
    public function detail()
    {
        return view('landing.detail');
    }
}