<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function welcome()
    {
        if (!Auth::user()) {
            return redirect('login');
        }
        return redirect('menu');
    }


    public function showLogin()
    {
        return view('auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if (!empty($user)) {
            $remember = false;
            if ($request->remember == 'on') {
                $remember = true;
            }
            Auth::login($user, $remember);
            \Session::flash('success', "You are logged in successfully.");
            return redirect()->intended('menu');
        }
        \Session::flash('error', "Invalid Credentials Provided!");
        return redirect("login");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
