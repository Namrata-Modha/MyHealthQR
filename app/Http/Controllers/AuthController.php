<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Auth\Events\Registered;
use App\Models\Log;
use App\Models\Notification;
use Carbon\Carbon;

class AuthController extends Controller {
    
    // Show Registration Page
    public function showRegistrationForm() {
        return view('auth.register');
    }

    // Register User
    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|edu|gov|ca|uk|in|info|io|co)$/i'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'date_of_birth' => 'required|date',
            'pipeda_consent' => 'required|boolean',
            'security_agreement_signed' => 'required|boolean',
            'guardian_consent' => [
                function ($attribute, $value, $fail) use ($request) {
                    $dob = new DateTime($request->date_of_birth);
                    $today = new DateTime();
                    $age = $today->diff($dob)->y;

                    if ($age < 18 && !$value) {
                        $fail('Guardian consent is required for users under 18.');
                    }
                }
            ]
        ], [
            'email.regex' => 'Email must have a valid domain like .com, .net, .org, etc.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*).',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Keeps previous values in the form
        }

        
        $user = User::create([
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active'
        ]);
    
        UserProfile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'guardian_consent' => $request->guardian_consent ?? false,
            'pipeda_consent' => $request->pipeda_consent,
            'security_agreement_signed' => $request->security_agreement_signed
        ]);
        
        /**
         * Keeps the user logged in after registration so they can proceed to email verification without having to log in again.
         * 
         * This approach enhances user experience by reducing the number of steps required to complete the registration process.
         * It ensures that users can immediately verify their email without the need to log in again, which can be a potential barrier.
         */
        Auth::login($user);
        
        // Send email verification notification
        event(new Registered($user));

        // Log the email sending activity
        $log = Log::create([
            'qr_code_id' => null, // Not related to QR code in this case
            'view_timestamp' => Carbon::now(), // Timestamp for when the email was sent
        ]);

        // Insert notification entry
        Notification::create([
            'user_id' => $user->id,
            'log_id' => $log->id,
            'notification_type' => 'Email Verification',
            'created_at' => Carbon::now(),
        ]);
    
        return redirect()->route('verification.notice')->with('success', 'Registration successful! Please verify your email.');
    }
    

    // Show Login Page
    public function showLoginForm() {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**
         * Check if the "Remember Me" option is selected and attempt to authenticate the user.
         * - `Auth::attempt($credentials, $remember)`: Attempts to authenticate the user with the provided credentials and the "Remember Me" option.
         * - If authentication is successful:
         *   - Regenerates the session to prevent session fixation.
         *   - Redirects the user to the intended URL (default is '/dashboard') with a success message.
         */
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput($request->only('email', 'remember'));
}


    // Handle Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
