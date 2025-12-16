<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', __('Invalid email or password'));
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:akun,email'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'max:15'],
            'gender' => ['required', 'in:LAKI-LAKI,PEREMPUAN']
        ]);

        // dd($validated);
        $user = Akun::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_telp' => $validated['phone_number'],
            'jenis_kelamin' => $validated['gender']
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Show the form for requesting a password reset link.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the given user.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $user = Akun::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __('We can\'t find a user with that email address.')]);
        }

        // Generate reset token
        $token = Str::random(64);

        // Delete existing tokens for this user
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Store the token
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Create reset link
        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // TODO: Send email with reset link
        // For now, just redirect to reset form
        session()->flash('success', __('Password reset link has been sent!'));

        return redirect($resetLink);
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm($token, Request $request)
    {
        $email = $request->query('email');
        
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => __('Email is required.')]);
        }

        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    /**
     * Reset the password for the given token.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Akun::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => __('We can\'t find a user with that email address.')]);
        }

        // Check if token exists and is valid
        $resetToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return back()->withErrors(['token' => __('This password reset token is invalid.')]);
        }

        // Check if token is not expired (24 hours)
        if (now()->diffInMinutes($resetToken->created_at) > 1440) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => __('This password reset token has expired.')]);
        }

        // Update password
        $user->update(['password' => Hash::make($request->password)]);

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', __('Your password has been reset successfully! Please login with your new password.'));
    }
}
