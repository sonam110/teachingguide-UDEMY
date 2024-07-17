<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        return view('index');
    }

    public function showResetForm( $token = null )
    {
        if (auth()->guest() && is_null( $token )) {
            return redirect('password/email');
        }

        if (auth()->check() && is_null( $token )) {
             // user is logged in and has no token, in other words, he/she access this route by
             // clicking a link pointing to "password/reset", so we generate a new token and save it
             // to the password_resets table
            $token = \Password::getRepository()->create( auth()->user() );
        }

        return view( 'auth.passwords.reset' )->with( 'token', $token );
    }
}
