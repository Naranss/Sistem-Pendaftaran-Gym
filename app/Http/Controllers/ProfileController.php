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
                    $oldPath = public_path($user->profile_photo_path);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Store new photo in public/assets/profilPhoto/
                $file = $request->file('photo');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/profilPhoto'), $filename);
                
                $path = 'assets/profilPhoto/' . $filename;
                $user->profile_photo_path = $path;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => __('Photo uploaded successfully!'),
                    'photo_url' => asset($path)
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
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update basic information
        $user->nama = $validated['name'];
        $user->email = $validated['email'];
        $user->no_telp = $validated['phone'];

        // Handle password update
        if ($request->filled('password')) {
            // If trying to set a new password, require current password
            if (!$request->filled('current_password')) {
                return back()
                    ->withErrors(['current_password' => __('Current password is required to set a new password.')])
                    ->withInput();
            }

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
                    $oldPath = public_path($user->profile_photo_path);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Store new photo in public/assets/profilPhoto/
                $file = $request->file('photo');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/profilPhoto'), $filename);
                
                $user->profile_photo_path = 'assets/profilPhoto/' . $filename;
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