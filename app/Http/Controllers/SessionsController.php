<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\LoginRequest;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
{
    $attributes = request()->validate([
        'username' => ['required', 'string'], // Ensure no email validation
        'password' => 'required'
    ]);

    // Explicitly map the credentials
    $credentials = [
        'username' => $attributes['username'],
        'password' => $attributes['password'],
    ];

    Log::info('Credentials for login attempt: ', $credentials);

    if (!auth()->attempt($credentials)) {
        throw ValidationException::withMessages([
            'username' => 'Your provided credentials could not be verified.'
        ]);
    }

    session()->regenerate();

    return redirect('/dashboard');
}
    public function show()
{
    request()->validate([
        'username' => 'required', // Changed from email
    ]);

    $status = Password::sendResetLink(
        request()->only('username') // Changed from email
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['username' => __($status)]);
}

public function update()
{
    request()->validate([
        'token' => 'required',
        'username' => 'required', // Changed from email
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        request()->only('username', 'password', 'password_confirmation', 'token'), // Changed from email
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password) // Ensure hashing
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['username' => [__($status)]]);
}

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
