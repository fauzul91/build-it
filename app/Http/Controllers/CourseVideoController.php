<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('course_video.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['course_id'] = $course->id;

        CourseVideo::create($validated);

        return redirect()->route('courses.show', $courseId)->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($courseId, $videoId)
    {
        $course = Course::findOrFail($courseId);
        $video = CourseVideo::where('course_id', $courseId)->findOrFail($videoId);

        return view('course_video.edit', compact('course', 'video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $courseId, $videoId)
    {
        $video = CourseVideo::where('course_id', $courseId)->findOrFail($videoId);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $video->update($validated);

        return redirect()->route('courses.show', $courseId)->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
