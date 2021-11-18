<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Hash;
use Session;

class LoginController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
       
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                        ->withSuccess('Signed in');
        }
        else {
            $errors = [$request->email => trans('auth.failed')];
            return redirect()->back()
            ->withErrors($errors);
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }


    public function index()
    {
        return view('login');
    }

    

    public function logOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
