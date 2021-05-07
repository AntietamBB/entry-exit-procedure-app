<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
    	$credentials = $request->only('email', 'password');

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            if(Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('/');
            }
        } else {
            $request->session()->flash('message', 'Invalid Username or Password !');
            $request->session()->flash('alert_class', 'danger');

            return redirect()->intended('sign-in');
        }
    }

    public function sign_in() {
        $value = Session::get('notifys');
//         echo '<pre>';
// print_r($value);
// exit;
        return view('auth.signin');
    }

    public function sign_up() {
        
        return view('auth.signup');
    }

    public function signout() {
        Auth::logout();
        Session::flush();

    	return redirect()->intended('sign-in');
    }

    public function register(Request $request) {
    	$user = User::create([
    		'name'        => $request->name,
    		'email'       => $request->email,
    		'password'    => Hash::make($request->password)
    	]);

    	$credentials = $request->only('email', 'password');

    	if(Auth::attempt($credentials)) {
    		return redirect()->intended('dashboard');
    	}
    }
}
