<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $primaryKey = 'answer_id';

    protected $fillable = [
        'attempt_id',
        'question_id',
        'student_answer',
        'is_correct',
        'answered_at',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
