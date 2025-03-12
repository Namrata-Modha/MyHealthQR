<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the user profiles.
     *
     * This method is responsible for retrieving and displaying
     * a list of user profiles from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Fetch the privacy settings safely
        $privacySettings = $profile->privacy_settings ?? '{}'; // Ensure it's at least an empty JSON object

        // Decode to check if it's valid JSON
        if (is_array($privacySettings)) {
            $decodedSettings = $privacySettings; // If already an array, use it directly
        } else {
            $decodedSettings = json_decode($privacySettings, true);
        }

        // If JSON decoding fails or returns null, reset to empty array
        if (!is_array($decodedSettings)) {
            $decodedSettings = [];
        }

        // Define the default settings (only apply if the key is missing)
        $defaultSettings = [
            // User Profile Fields
            'contact_phone' => 'visible',
            'emergency_contact_name' => 'visible',
            'emergency_contact_phone' => 'visible',

            // Medical Info Fields
            'allergies' => 'visible',
            'conditions' => 'visible',
            'medications' => 'visible',
            'has_insurance' => 'visible',
            'quickhelp_question_1' => 'visible',
            'quickhelp_question_2' => 'visible',
            'quickhelp_question_3' => 'visible',
        ];

        // Merge user settings with defaults (user preferences are preserved)
        $mergedSettings = array_merge($defaultSettings, $decodedSettings);

        // Encode the final JSON properly for frontend use
        $privacySettings = json_encode($mergedSettings);

        return view('user_profile', compact('user', 'profile', 'privacySettings'));
    }

    /**
     * Update the user's profile information.
     *
     * @param \Illuminate\Http\Request $request The request object containing the user's updated profile data.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_phone' => ['nullable', 'regex:/^(\+?\d{1,3}[-. ]?)?(\(?\d{3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/'],
            'emergency_contact_name' => 'nullable|string|min:3|max:100',
            'emergency_contact_phone' => [
                'nullable',
                'regex:/^(\+?\d{1,3}[-. ]?)?(\(?\d{3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->filled('emergency_contact_name') && empty($value)) {
                        $fail('Emergency Contact Phone is required when Emergency Contact Name is provided.');
                    }
                }
            ],
            'privacy_settings' => 'nullable|json',
        ], [
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'contact_phone.regex' => 'Enter a valid phone number.',
            'emergency_contact_name.min' => 'Emergency Contact Name must be at least 3 characters.',
            'emergency_contact_phone.regex' => 'Enter a valid Emergency Contact Phone number.',
        ]);
        
        $user = Auth::user();
        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        // Save visibility settings in JSON format
        $privacySettings = $request->privacy_settings ? json_decode($request->privacy_settings, true) : [];

        $profile->fill($request->except(['privacy_settings']));
        $profile->privacy_settings = json_encode($privacySettings);
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}
