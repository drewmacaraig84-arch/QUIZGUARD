<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $primaryKey = 'question_id';

    protected $fillable = [
        'bank_id',
        'question_text',
        'question_type',
        'options',
        'correct_answers',
        'points',
    ];

    public function bank()
    {
        return $this->belongsTo(QuestionBank::class, 'bank_id');
    }
}
