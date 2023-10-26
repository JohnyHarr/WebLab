<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function authentication() {
        return view('authentication');
    }

    public function registration() {
        return view('registration');
    }

    public function authenticate(Request $request) {
        if (Auth::check()) {
            return redirect()->route('main');
        }

        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:50',
        ]);
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], true)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.adminHome');
            } else if ((Auth::user()->role == 'editor')) {
                return redirect()->route('editor.editorHome');
            } else {
                return redirect()->route('home');
            }
        } else {
            return back()->withErrors(['invalidCredentials' => 'invalidCredentials']);
        }
    }

    public function register(Request $request) {
        if (Auth::check()) {
            return redirect()->route('main');
        }

        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:50',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'role' => $credentials['role']
        ]);

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', auth()->user()->name);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('home');
    }


    public function test(Request $request)
    {
        dd($request);
    }

    public function checkEmail(Request $request) {
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            return response('setEmailAvailability(false);', 200)->header('Content-Type', 'text/javascript');
        } else {
            return response('setEmailAvailability(true);', 200)->header('Content-Type', 'text/javascript');
        }
    }
}

