<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QRCodes extends Model
{
    protected $table = 'qr_codes';
    protected $fillable = ['user_id','qr_code', 'created_at'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

}