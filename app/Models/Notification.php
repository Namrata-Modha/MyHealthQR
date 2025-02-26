<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'log_id',
        'notification_type',
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false; // Using manual timestamps

    // Relationship: Notification belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Notification belongs to a log
    public function log()
    {
        return $this->belongsTo(Log::class, 'log_id');
    }
}
