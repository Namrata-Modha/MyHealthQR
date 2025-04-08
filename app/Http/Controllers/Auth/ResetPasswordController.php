<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Password validation rules.
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ];
    }

    /**
     * Customize password validation error messages.
     */
    protected function validationErrorMessages()
    {
        return [
            'password.regex' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*).',
        ];
    }

    /**
     * Redirect after successful reset.
     */
    protected $redirectTo = '/login';
}
