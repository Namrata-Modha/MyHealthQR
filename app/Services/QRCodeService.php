<?php

namespace App\Services;

use App\Models\QRCodes;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class QRCodeService
{
    public function generateAndStoreQRCode($userId)
    {
        $uniqueCode = Str::random(40); // Generate a 40-character unique code

        // Ensure 'qr_codes' directory exists inside 'public'
        $directory = public_path('qr_codes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = "qr_code_{$userId}.svg";
        $filePath = "{$directory}/{$fileName}";

        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd() // Use SVG instead of Png
        );
        
        $writer = new Writer($renderer);
        $qrCodeData = $writer->writeString($uniqueCode);
        
        file_put_contents($filePath, $qrCodeData);

        if (file_exists($filePath)) {
            \Log::info("✅ QR code saved at {$filePath}");
        } else {
            \Log::error("❌ Failed to save QR code at {$filePath}");
        }

        // Save QR code details in the database
        $qrCode = QRCodes::create([
            'user_id' => $userId,
            'qr_code' => $uniqueCode,
            'created_at' => now(),
            'quick_help_enabled' => false,
        ]);

        return $qrCode;
    }
}
