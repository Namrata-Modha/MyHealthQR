<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalInfo;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class MedicalInfoController extends Controller
{
    /**
     * Display the medical information view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $medicalInfo = $user->medicalInfo;

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
            'quickhelp_answer_1' => 'visible',
            'quickhelp_answer_2' => 'visible',
            'quickhelp_answer_3' => 'visible',
        ];

        // Merge user settings with defaults (user preferences are preserved)
        $mergedSettings = array_merge($defaultSettings, $decodedSettings);

        // Encode the final JSON properly for frontend use
        $privacySettings = json_encode($mergedSettings);

        // Ensure `has_insurance` is passed from `user_profiles`
        $hasInsurance = $profile->has_insurance ?? false;

        $healthQrEnabled = $profile->quick_help_enabled ?? false;

        return view('medical_info', compact('medicalInfo', 'hasInsurance', 'privacySettings', 'healthQrEnabled'));
    }
    /**
     * Update the medical information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $medicalInfo = $user->medicalInfo ?? new MedicalInfo(['user_id' => $user->id]);

        // Save medical info
        $medicalInfo->fill($request->only([
            'allergies', 'conditions', 'medications',
            'quickhelp_answer_1', 'quickhelp_answer_2', 'quickhelp_answer_3'
        ]));
        $medicalInfo->save();

        // Save `has_insurance` and `quick_help` in `user_profiles`
        $userProfile = $user->profile ?? new UserProfile(['user_id' => $user->id]);

        // Privacy settings update (if provided)
        $privacySettings = $request->privacy_settings ? json_decode($request->privacy_settings, true) : [];

        $userProfile->fill($request->except(['privacy_settings']));
        $userProfile->privacy_settings = json_encode($privacySettings);
        $userProfile->has_insurance = $request->boolean('has_insurance');
        $userProfile->quick_help_enabled = $request->boolean('quick_help_enabled');
        $userProfile->save();

        return redirect()->back()->with('success', 'Medical information updated successfully.');
    }

}
