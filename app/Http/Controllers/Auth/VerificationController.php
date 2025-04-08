<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Services\QRCodeService;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Notification;

class VerificationController extends Controller
{
    protected $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->middleware('auth'); // Ensure user is logged in to access verification
        $this->middleware('signed')->only('verify'); // Signed URL for email verification
        $this->middleware('throttle:6,1')->only('verify', 'resend'); // Throttle requests
        $this->qrCodeService = $qrCodeService;
    }

    public function verify(EmailVerificationRequest $request)
    {
        $user = $request->user();

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            if (!$user->qrCode) {
                // Generate QR Code
                $qrCode = $this->qrCodeService->generateAndStoreQRCode($user->id);

                // Log QR code generation
                $log = Log::create([
                    'qr_code_id' => $qrCode->id,
                    'view_timestamp' => now(),
                    'created_at' => Carbon::now(), // Log creation time
                ]);

                // Create notification
                Notification::create([
                    'user_id' => $user->id,
                    'log_id' => $log->id,
                    'notification_type' => 'QR Code Generated',
                    'status' => 'read',
                ]);
            }

            return redirect()->route('login.form')->with('success', 'Email verified and QR code generated! Please log in.');
        }

        return redirect()->route('login.form')->with('info', 'Email already verified. Please log in.');
    }

}
