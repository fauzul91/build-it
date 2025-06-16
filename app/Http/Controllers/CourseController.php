<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\TutorVerif;
use App\Models\CourseVideo;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseProgress;

class CourseController extends Controller
{
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
        $verif = TutorVerif::where('tutor_id', $tutorId)->first();

        $tutorDraftCourses = Course::where('tutor_id', $tutorId)
            ->where('status', 'draft')
            ->paginate(10);

        return view('course.tutor.draft', compact('tutorDraftCourses', 'verif'));
    }
    public function tutorStatusCourses()
    {
        $tutorId = auth()->id();
        $tutorStatusCourses = Course::where('tutor_id', $tutorId)
            ->where('status', '!=', 'draft')
            ->paginate(10);
        return view('course.tutor.status', compact('tutorStatusCourses'));
    }
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

        return redirect()->route('courses.index')->with('success', 'Course berhasil dibuat.');
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

    public function adminShow(string $id)
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

        if (auth()->user()->hasRole('tutor') && $course->status === 'rejected') {
            return redirect()->route('course.tutor.status', ['status' => 'rejected'])->with('success', 'Course berhasil diperbarui. Silakan ajukan ulang.');
        }

        return redirect()->route('courses.index')->with('success', 'Course berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course berhasil dihapus.');
    }

    public function approve($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->save();

        return redirect()->route('course.active.index')->with('success', 'Course berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->rejection_reason = $request->rejection_reason;
        $course->save();

        return redirect()->route('course.active.index')->with('success', 'Course berhasil ditolak.');
    }

    public function publish($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'pending';
        $course->save();

        return redirect()->route('course.tutor.status')->with('success', 'Course berhasil dipublish.');
    }

    public function preview($courseId)
    {
        $course = Course::with('videos')->findOrFail($courseId);
        return view('course.preview', compact('course'));
    }
    public function adminPreview($courseId)
    {
        $course = Course::with('videos')->findOrFail($courseId);
        return view('course.preview', compact('course'));
    }
    public function resubmit($id)
    {
        $course = Course::findOrFail($id);

        if (auth()->id() === $course->tutor_id && $course->status === 'rejected') {
            $course->status = 'pending';
            $course->rejection_reason = null;
            $course->save();

            return redirect()->back()->with('success', 'Course berhasil diajukan ulang.');
        }

        return redirect()->back()->with('error', 'Course tidak bisa diajukan ulang.');
    }
    public function studentCourse()
    {
        $userId = auth()->id();
        $courseIds = Transaction::where('user_id', $userId)
            ->where('status', 'completed')
            ->pluck('course_id');

        $courses = Course::whereIn('id', $courseIds)->get();
        return view('student.my-courses.index', compact('courses'));
    }
    public function studentVideo($slug)
    {
        $course = Course::with('videos')->where('slug', $slug)->firstOrFail();
        $video = $course->videos()->first(); // ambil video pertama

        if (!$video) {
            return back()->with('error', 'Tidak ada video untuk course ini.');
        }

        $userId = auth()->id();

        $completedVideos = CourseProgress::where('user_id', $userId)
            ->where('course_id', $course->id)
            ->where('is_completed', true)
            ->pluck('course_video_id');

        $isCurrentVideoCompleted = $completedVideos->contains($video->id);
        $completedCount = $completedVideos->count();
        $totalVideos = $course->videos->count();
        $percentage = $totalVideos > 0 ? round(($completedCount / $totalVideos) * 100) : 0;
        return view('student.my-courses.show', compact(
            'course',
            'completedVideos',
            'isCurrentVideoCompleted',
            'completedCount',
            'totalVideos',
            'percentage'
        ))->with([
                    'currentVideo' => $video
                ]);
    }

    public function markCompleted(Request $request, CourseVideo $video)
    {
        $progress = CourseProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id' => $video->course_id,
                'course_video_id' => $video->id,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Video ditandai sebagai selesai.',
            'video_id' => $video->id,
            'course_id' => $video->course_id,
            'completed' => true,
        ]);
    }
    public function searchActiveCourse(Request $request)
    {
        $q = $request->query('q');
        $courses = Course::with('category')
            ->where('name', 'like', '%' . $q . '%')
            ->where('status', 'approved')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'thumbnail' => $course->thumbnail,
                    'category_name' => $course->category->name ?? 'Kategori',
                ];
            });

        return response()->json($courses);
    }
}