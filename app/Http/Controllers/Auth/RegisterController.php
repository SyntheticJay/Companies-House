<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show the register page
     *
     * @param   Request  $request  The request object
     * @return  \Illuminate\View\View
     */
    public function show(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        
        return view('auth.register');    
    }

    /**
     * Handle the registering of the user
     *
     * @param   RegisterRequest  $request  The request object
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        if ($validated['password'] != $validated['confirm']) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['confirm' => 'The passwords do not match', 'password' => 'The passwords do not match']);
        }

        try {
            $user = User::create([
                'name'     => $validated['username'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone'    => $validated['phone'] ?? null,
            ]);    
        } catch (\Exception $e) {
            report($e);
            Log::error('Error registering user ' . $validated['username'] . ' with email ' . $validated['email'] . ' and phone ' . $validated['phone']);
            return;
        }

        return redirect()
                ->route('login')
                ->with('success', 'You have successfully registered. Please login to continue');
    }
}
