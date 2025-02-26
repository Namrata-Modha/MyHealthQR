<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth',
        'contact_phone', 'contact_email', 'emergency_contact_name',
        'emergency_contact_phone', 'privacy_settings', 'pipeda_consent',
        'security_agreement_signed', 'has_insurance', 'guardian_consent'
    ];

    protected $casts = [
        'privacy_settings' => 'array',
        'pipeda_consent' => 'boolean',
        'security_agreement_signed' => 'boolean',
        'has_insurance' => 'boolean',
        'guardian_consent' => 'boolean'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
