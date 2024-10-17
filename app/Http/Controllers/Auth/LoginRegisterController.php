<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * instantiate a new login 
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout','dashboard'
        ]);
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */

    public function register()
    {
        return response()->view('auth.register');
    }

    /**
     * store
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth ::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->withSuccess('success', 'You have successfully registered.');
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return response()->view('auth.login');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('success', 'You have successfully logged in.');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     * 
     */

    public function dashboard()
    {
        if (Auth::check()) {
            return response()->view('dashboard');
        }

        return redirect()->route('login')
        ->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('logout');;
    }

}