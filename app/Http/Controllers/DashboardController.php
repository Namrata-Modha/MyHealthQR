<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\QRCodes;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $qrCode = QRCodes::where('user_id', $user->id)->first();

        $qrCodeImage = null;
        if ($qrCode) {
            // Find the stored QR code image in the storage
            $qrCodeImage = collect(Storage::disk('public')->files('qr_codes'))
                ->filter(fn($file) => str_contains($file, 'user_' . $user->id))
                ->sort()
                ->last(); // Get the latest file
        }

        return view('dashboard', compact('qrCode', 'qrCodeImage'));
    }
}
