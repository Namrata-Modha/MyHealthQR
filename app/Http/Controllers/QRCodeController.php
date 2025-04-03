<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QRCodes;
use App\Models\UserProfile;
use App\Models\MedicalInfo;
use App\Models\Log;
use App\Models\Notification;
use Carbon\Carbon;

class QRCodeController extends Controller
{
    /**
     * Show the QR code details for third-party access.
     *
     * @param string $qr_code_key The QR code key to look up.
     * @return \Illuminate\View\View
     */
    public function show($qr_code_key)
    {
        // Find the QR code in the database
        $qrCode = QRCodes::where('qr_code', $qr_code_key)->first();

        // If QR code doesn't exist, show 404
        if (!$qrCode) {
            abort(404, "QR Code Not Found");
        }

        // Fetch user data
        $userProfile = UserProfile::where('user_id', $qrCode->user_id)->first();
        $medicalInfo = MedicalInfo::where('user_id', $qrCode->user_id)->first();

        // Decode privacy settings
        $privacySettings = json_decode($userProfile->privacy_settings ?? '{}', true) ?? [];

        // Prepare the visible data
        $thirdPartyView = [
            'first_name' => $userProfile->first_name ?? 'N/A',
            'last_name' => $userProfile->last_name ?? 'N/A',
        ];

        // Check visibility for contact and emergency details
        $fields = ['contact_phone', 'emergency_contact_name', 'emergency_contact_phone', 'has_insurance'];
        foreach ($fields as $field) {
            if (($privacySettings[$field] ?? 'invisible') === 'visible') {
                $thirdPartyView[$field] = $userProfile->$field ?? 'N/A';
            }
        }

        // Check visibility for medical info
        $medicalFields = ['allergies', 'conditions', 'medications'];
        foreach ($medicalFields as $field) {
            if (($privacySettings[$field] ?? 'invisible') === 'visible') {
                $thirdPartyView[$field] = !empty($medicalInfo->$field) ? json_encode($medicalInfo->$field) : 'N/A';
            }
        }

        // Check Quick Help section
        $thirdPartyView['quick_help'] = [];
        if ($userProfile->quick_help_enabled) {
            $thirdPartyView['quick_help_enabled'] = 'Enabled';

            $quickHelpQuestions = [
                'quickhelp_answer_1' => 'What immediate steps should be taken in case of an emergency?',
                'quickhelp_answer_2' => 'What medications or treatments are needed in an emergency situation?',
                'quickhelp_answer_3' => 'What should be done if the condition worsens?',
            ];

            foreach ($quickHelpQuestions as $key => $question) {
                if (($privacySettings[$key] ?? 'invisible') === 'visible' && !empty($medicalInfo->$key)) {
                    $thirdPartyView['quick_help'][] = [
                        'question' => $question,
                        'answer' => $medicalInfo->$key,
                    ];
                }
            }
        }

        // LOG THE QR CODE SCAN
        $log = Log::create([
            'qr_code_id' => $qrCode->id,
            'view_timestamp' => Carbon::now(),
        ]);

        // Insert notification entry
        Notification::create([
            'user_id' => $qrCode->user_id,
            'log_id' => $log->id,
            'notification_type' => 'QR Scanned',
            'created_at' => Carbon::now(),
        ]);

        return view('qr_scanned_view', compact('thirdPartyView'));
    }
}
