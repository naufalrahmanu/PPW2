<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class LoginRegisterController extends Controller
{

    protected $middleware = [];
    protected $except = [];
    /**
     * instantiate a new login 
     */
    public function __construct()
    {
        $this->middleware = 'guest'; // Define the middleware property
        $this->except = ['logout','dashboard']; // Define the except property
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
            'password' => 'required|min:8|confirmed',
            'photo' => 'image|nullable|max:10000',

        ]);

        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $path = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = $path . '_' . time();
            // Save original image
            $filenameOriginal = $filename . '_Original.' . $extension;
            $request->file('photo')->storeAs('images/users/original', $filenameOriginal);
            // Create and save square image
            $squareImage = $manager->read($request->file('photo')->path());
            $smallestDimension = min($squareImage->width(), $squareImage->height());
            $squareImage->crop($smallestDimension, $smallestDimension, ($squareImage->width() - $smallestDimension) / 2, ($squareImage->height() - $smallestDimension) / 2);
            $squareImage->save(storage_path('app/public/images/users/square/' . $filename . '_Square.' . $extension));
            // Create and save thumbnail
            $thumbnailImage = $squareImage->scale(width: 100)->toJpeg();
            $thumbnailImage->save(storage_path('app/public/images/users/thumbnail/' . $filename . '_Thumbnail.' . $extension));
        } else {
            $filename = null;
            $extension = null;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 'admin',
            'photo' => $filename,
            'photo_ext' => $extension,
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors(['email' => 'Your provided credentials do not match in our records.',])->onlyInput('email');
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * 
     */

    public function dashboard()
    {
        if (Auth::check()) {
            return response()->view('auth.dashboard');
        } else {
            abort(403);
        }
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
