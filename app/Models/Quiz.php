<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $primaryKey = 'quiz_id';

    protected $fillable = [
        'teacher_id',
        'bank_id',
        'subject_id',
        'title',
        'section',
        'time_limit_min',
        'max_violation',
        'passing_score',
        'attempts_allowed',
        'shuffle_questions',
        'number_of_questions',
        'shuffle_answers',
        'grading_method',
        'open_at',
        'status',
        'closed_at',
    ];

    protected $casts = [
        'open_at'   => 'datetime',
        'closed_at' => 'datetime',
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_id');
    }

    public function bank()
    {
        return $this->belongsTo(QuestionBank::class, 'bank_id');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'quiz_id');
    }
}
