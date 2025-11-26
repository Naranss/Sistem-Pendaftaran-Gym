<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the user profile edit form.
     */
    public function edit()
    {
        return view('pages.dashboard');
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $isPhotoOnly = $request->hasFile('photo') && !$request->filled('name');

        // Photo-only upload path (from AJAX)
        if ($isPhotoOnly) {
            // Validate ONLY photo - skip all other validations
            $validated = $request->validate([
                'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            // Handle photo upload
            try {
                // Delete old photo if exists
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                // Store new photo
                $path = $request->file('photo')->store('profile-photos', 'public');
                $user->profile_photo_path = $path;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => __('Photo uploaded successfully!')
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => __('Failed to upload photo. Please try again.')
                ], 400);
            }
        }

        // Full profile update path (from form submit)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('akun', 'email')->ignore($user->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update basic information
        $user->nama = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telp = $validated['phone'];

        // Handle password update
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => __('The provided password does not match your current password.')])
                    ->withInput();
            }

            $user->password = Hash::make($request->password);
        }

        // Handle photo upload in full update
        if ($request->hasFile('photo')) {
            try {
                // Delete old photo if exists
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                // Store new photo
                $path = $request->file('photo')->store('profile-photos', 'public');
                $user->profile_photo_path = $path;
            } catch (\Exception $e) {
                return back()
                    ->withErrors(['photo' => __('Failed to upload photo. Please try again.')])
                    ->withInput();
            }
        }

        $user->save();

        return back()->with('success', __('Profile updated successfully!'));
    }
}