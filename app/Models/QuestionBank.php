<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $primaryKey = 'bank_id';

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'bank_title',
        'source_file_name',
        'uploaded_at',
    ];

   public function questions()
    {
        return $this->hasMany(Question::class, 'bank_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'bank_id');
    }
}