<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'qr_code_id',
        'view_timestamp',
    ];

    public $timestamps = false; // Since created_at is manually handled

    // Relationship: Log belongs to a QR code
    public function qrCode()
    {
        return $this->belongsTo(QRCodes::class, 'qr_code_id');
    }

    // Relationship: Log has many notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'log_id');
    }
}
