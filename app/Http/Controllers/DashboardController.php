<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\QRCodes;
use App\Models\UserProfile;
use App\Models\MedicalInfo;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View The dashboard view.
     */
    public function show()
    {
        $user = Auth::user();
        $qrCode = QRCodes::where('user_id', $user->id)->first();
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $medicalInfo = MedicalInfo::where('user_id', $user->id)->first();

        // Decode privacy settings stored as JSON
        // Ensure privacy_settings is always a valid JSON string before decoding
        $privacySettings = $userProfile->privacy_settings;

        // If it's not a string (i.e., already an array), use it as-is; otherwise, decode it
        if (!is_string($privacySettings)) {
            $privacySettings = []; // Default empty array if null or invalid
        } else {
            $privacySettings = json_decode($privacySettings, true) ?? [];
        }


        // Third-Party View (Only Show "Visible" Fields)
        $thirdPartyView = [];

        // 1. Name (Always Visible)
        $thirdPartyView['first_name'] = $userProfile->first_name;
        $thirdPartyView['last_name'] = $userProfile->last_name;

        // 2-5: Contact & Emergency Info (Based on Visibility)
        foreach (['contact_phone', 'emergency_contact_name', 'emergency_contact_phone', 'has_insurance'] as $field) {
            if (($privacySettings[$field] ?? 'invisible') === 'visible') {
                $thirdPartyView[$field] = $userProfile->$field;
            }
            // 5. Has Insurance (Convert Boolean to Yes/No)
            if (($privacySettings['has_insurance'] ?? 'invisible') === 'visible') {
                $thirdPartyView['has_insurance'] = $userProfile->has_insurance ? 'Yes' : 'No';
            }
        }

        // 6-8: Medical Info (Based on Visibility)
        foreach (['allergies', 'conditions', 'medications'] as $field) {
            if (($privacySettings[$field] ?? 'invisible') === 'visible') {
                $thirdPartyView[$field] = json_encode($medicalInfo->$field ?? []);
            }
        }

        // 9: Quick Help (First Check If Enabled)
        $quickHelpQuestions = [
            'quickhelp_answer_1' => 'What immediate steps should be taken in case of an emergency?',
            'quickhelp_answer_2' => 'What medications or treatments are needed in an emergency situation?',
            'quickhelp_answer_3' => 'What should be done if the condition worsens?',
        ];
        
        // Ensure quick_help is always set as an array
        $thirdPartyView['quick_help'] = [];

        if ($userProfile->quick_help_enabled) {
            $thirdPartyView['quick_help_enabled'] = 'Enabled';
            foreach ($quickHelpQuestions as $key => $question) {
                if (($privacySettings[$key] ?? 'invisible') === 'visible') {
                    $thirdPartyView['quick_help'][] = [
                        'question' => $question,
                        'answer' => $medicalInfo->$key ?? 'No answer provided',
                    ];
                }
            }
        }

        $qrCodeImage = null;
        if ($qrCode) {
            $qrCodeImage = collect(Storage::disk('public')->files('qr_codes'))
                ->filter(fn($file) => str_contains($file, 'user_' . $user->id))
                ->sort()
                ->last();
        }

        return view('dashboard', compact('qrCode', 'qrCodeImage', 'thirdPartyView'));
    }
}
