<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pendingCourses(Request $request)
    {
        $verificationCourses = Course::where('status', 'pending')->paginate(10);
        return view('course.admin.pending', compact('verificationCourses'));
    }

    public function activeCourses()
    {
        $activeCourses = Course::where('status', 'approved')->paginate(10);
        return view('course.admin.active', compact('activeCourses'));
    }

    public function index()
    {
        $tutorId = auth()->id();
        $tutorDraftCourses = Course::where('tutor_id', $tutorId)
            ->where('status', 'draft')
            ->paginate(10);
        return view('course.tutor.draft', compact('tutorDraftCourses'));
    }

    // Status Courses for each tutor
    public function tutorStatusCourses()
    {
        $tutorId = auth()->id();
        $tutorStatusCourses = Course::where('tutor_id', $tutorId)
            ->where('status', '!=', 'draft')
            ->paginate(10);
        return view('course.tutor.status', compact('tutorStatusCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('course.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|string|in:free,paid',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $slug = Str::slug($request->name);
        $request->merge(['slug' => $slug]);

        if ($request->type === 'paid') {
            $request->validate([
                'price' => 'required|numeric|min:1000',
            ]);
        } else {
            $request->merge(['price' => 0]);
        }

        $data = $request->all();
        if (auth()->user()->hasRole('tutor')) {
            $data['tutor_id'] = auth()->id();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        $course = Course::with('videos')->findOrFail($id);
        return view('course.show', compact('course', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $course = Course::findOrFail($id);
        return view('course.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'type' => 'sometimes|in:free,paid',
            'price' => 'sometimes|nullable|numeric|min:1000',
            'thumbnail' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('name')) {
            $request->merge(['slug' => Str::slug($request->name)]);
        }

        if ($request->input('type') === 'free') {
            $request->merge(['price' => 0]);
        }

        $data = $request->all();

        if (auth()->user()->hasRole('tutor')) {
            $data['tutor_id'] = auth()->id();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function approve($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course approved successfully.');
    }

    public function reject($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course rejected successfully.');
    }

    public function publish($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'pending';
        $course->save();

        return redirect()->route('course.tutor.status')->with('success', 'Course published successfully.');
    }

    public function preview($courseId)
    {
        $course = Course::with('videos')->findOrFail($courseId);
        return view('course.preview', compact('course'));
    }
}