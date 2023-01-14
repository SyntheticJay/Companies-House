<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the login page
     *
     * @param   Request  $request  The request object
     * @return  \Illuminate\View\View
     */
    public function show(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle the login
     *
     * @param   RegisterRequest  $request  The request object
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (auth()->attempt(['name' => $validated['username'], 'password' => $validated['password']])) {
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    /**
     * Logout & kill the session
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
