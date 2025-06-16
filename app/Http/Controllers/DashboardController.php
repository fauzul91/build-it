<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\TutorVerif;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function tutorDashboard()
    {
        $user = auth()->user();
        $verif = TutorVerif::where('tutor_id', $user->id)->first();
        $tutorId = auth()->id();
        $courseIds = Course::where('tutor_id', $tutorId)->pluck('id');
        $totalRevenue = Transaction::whereIn('course_id', $courseIds)
            ->where('status', 'completed')
            ->sum('tutor_earning');
        $totalCourses = $courseIds->count();
        $totalStudents = Transaction::whereIn('course_id', $courseIds)
            ->where('status', 'completed')
            ->distinct('user_id')
            ->count('user_id');

        $last7Days = collect(range(6, 0))->map(function ($i) use ($courseIds) {
            $date = Carbon::today()->subDays($i);
            $total = Transaction::whereDate('created_at', $date)
                ->whereIn('course_id', $courseIds)
                ->where('status', 'completed')
                ->sum('tutor_earning');

            return [
                'date' => $date->format('Y-m-d'),
                'total' => $total
            ];
        });

        $recentTransactions = Transaction::with('user', 'course')
            ->whereIn('course_id', $courseIds)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('dashboard.tutor', compact(
            'totalRevenue',
            'totalCourses',
            'totalStudents',
            'last7Days',
            'recentTransactions',
            'verif'
        ));
    }
    public function adminDashboard()
    {
        $totalRevenue = Transaction::where('status', 'completed')->sum('platform_fee');
        $totalCourses = Course::count();
        $studentRole = Role::where('name', 'student')->first();
        $totalStudents = $studentRole ? $studentRole->users()->count() : 0;

        $last7Days = collect(range(6, 0))->map(function ($i) {
            $date = Carbon::today()->subDays($i);
            $total = Transaction::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('platform_fee');

            return [
                'date' => $date->format('Y-m-d'),
                'total' => $total
            ];
        });

        $recentTransactions = Transaction::with('user', 'course')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact(
            'totalRevenue',
            'totalCourses',
            'totalStudents',
            'last7Days',
            'recentTransactions'
        ));
    }
}
