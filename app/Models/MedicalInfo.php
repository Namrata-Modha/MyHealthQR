<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    use HasFactory;

    protected $table = 'medical_info';

    protected $fillable = [
        'user_id',
        'allergies',
        'conditions',
        'medications',
        'quickhelp_answer_1',
        'quickhelp_answer_2',
        'quickhelp_answer_3',
    ];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
