<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
        public function showLoginForm()
        {
            return view('auth.login'); // Assuming you have a login Blade view
        }

        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                //return redirect()->intended('/dashboard'); // Redirect to intended URL or dashboard
                return redirect()->route('test')->with('success', 'Inicio sesion exitosamente');
            
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }



            public function showRegistrationForm()
        {
            return view('auth.register'); // Assuming you have a login Blade view
        }
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

            Auth::login($user);
 
              return redirect()->route('test')->with('success', 'Registration successful!');
        }
       
       
        public function logout(Request $request)
        {
            Auth::logout(); // Clears the authentication information

            $request->session()->invalidate(); // Invalidates the user's session
            $request->session()->regenerateToken(); // Regenerates the CSRF token

            return redirect()->route('test')->with('success', 'Se cerro su sesion!');; // Redirects to the login page or another desired route
        }
}
