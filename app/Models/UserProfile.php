<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth',
        'contact_phone', 'emergency_contact_name', 'emergency_contact_phone',
        'privacy_settings', 'quick_help_enabled', 'pipeda_consent',
        'security_agreement_signed', 'has_insurance', 'guardian_consent'
    ];

    protected $casts = [
        'privacy_settings' => 'array',
        'pipeda_consent' => 'boolean',
        'security_agreement_signed' => 'boolean',
        'has_insurance' => 'boolean',
        'guardian_consent' => 'boolean',
        'quick_help_enabled' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
