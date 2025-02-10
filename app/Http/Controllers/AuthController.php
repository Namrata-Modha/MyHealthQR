<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\QrCode;

class AuthController extends Controller
{
    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        // 1️⃣ Validate input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',  // At least one lowercase letter
                'regex:/[A-Z]/',  // At least one uppercase letter
                'regex:/[0-9]/',  // At least one number
                'regex:/[@$!%*#?&]/', // At least one special character
            ],
            'date_of_birth' => 'required|date',
            'contact_phone' => 'nullable|string|max:15',
            'guardian_consent' => 'required_if:date_of_birth,' . now()->subYears(18)->format('Y-m-d') . '|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2️⃣ Create User
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // 3️⃣ Create User Profile
        UserProfile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->email,
            'privacy_settings' => json_encode([]),
            'guardian_consent' => $request->guardian_consent ?? false,
        ]);

        // 4️⃣ Generate and Store QR Code
        $qrCode = Str::uuid();
        QrCode::create([
            'user_id' => $user->id,
            'qr_code' => $qrCode,
            'expiration_date' => now()->addYear(),
        ]);

        // 5️⃣ Send Email Verification (Laravel's built-in)
        event(new Registered($user));

        return response()->json(['message' => 'User registered successfully. Please check your email for verification.', 'qr_code' => $qrCode], 201);
    }
}
