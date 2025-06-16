<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TutorVerif;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('student');

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    public function registerTutor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('tutor');

        return redirect()->route('tutor.verif')->with('success', 'Registrasi berhasil, silakan lengkapi verifikasi!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->hasRole('student')) {
                return redirect()->route('landing.home');
            }

            if ($user->hasRole('tutor')) {
                $tutorVerif = TutorVerif::where('tutor_id', $user->id)->first();

                if (!$tutorVerif) {
                    return redirect()->route('tutor.verif');
                }
                return redirect()->route('tutor.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('landing.home');
    }

    public function google_redirect(Request $request)
    {
        $role = $request->get('role', 'student');
        session(['register_role' => $role]);

        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(Str::random(16)),
            ]);

            if ($googleUser->email === 'fauzulakbar2575@gmail.com') {
                $user->assignRole('admin');
            } else {
                $role = session('register_role', 'student');
                $user->assignRole($role);
            }
        }

        session()->forget('register_role');

        Auth::login($user);

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('student')) {
            return redirect()->route('landing.home');
        }

        if ($user->hasRole('tutor')) {
            $tutorVerif = TutorVerif::where('tutor_id', $user->id)->first();

            if (!$tutorVerif) {
                return redirect()->route('tutor.verif')
                    ->with('success', 'Silakan lengkapi verifikasi terlebih dahulu!');
            }

            return redirect()->route('tutor.dashboard');
        }

        return redirect('/'); // fallback jika role tidak diketahui
    }
}