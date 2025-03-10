<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    use HasFactory;

    protected $table = 'medical_info';
    protected $fillable = [
        'user_id', 'allergies', 'conditions', 'medications', 'quickhelp_question_1', 'quickhelp_question_2', 'quickhelp_question_3'
    ];

    protected $casts = [
        'allergies' => 'array',
        'conditions' => 'array',
        'medications' => 'array',
        'quickhelp_question_1' => 'array',
        'quickhelp_question_2' => 'array',
        'quickhelp_question_3' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
