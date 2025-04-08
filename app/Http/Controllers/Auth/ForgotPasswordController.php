<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Blade file to enter email
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = strtolower(trim($request->email));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            // Insert into logs
            $logId = DB::table('logs')->insertGetId([
                // 'user_id'    => $user->id,
                'view_timestamp' => Carbon::now(),
            ]);

            // Insert into notifications
            DB::table('notifications')->insert([
                'user_id'           => $user->id,
                'notification_type' => 'Password Reset Requested',
                'log_id'            => $logId,
                'created_at'        => Carbon::now(),
            ]);

            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
