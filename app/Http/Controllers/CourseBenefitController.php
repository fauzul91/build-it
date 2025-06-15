<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseBenefit;

class CourseBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('course_benefit.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('course_benefit.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'benefit' => 'required|string|max:255',
        ]);

        $course->benefits()->create([
            'benefit' => $request->benefit,
        ]);

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'Benefit berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('course_benefit.edit', compact('course', 'benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, CourseBenefit $benefit)
    {
        $request->validate([
            'benefit' => 'required|string|max:255',
        ]);

        $benefit->update(['benefit' => $request->benefit]);

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'Benefit berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, CourseBenefit $benefit)
    {
        $benefit->delete();

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'Benefit berhasil dihapus.');
    }
}