<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
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
            Auth::login($user);
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
