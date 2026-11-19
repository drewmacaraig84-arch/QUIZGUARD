<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $primaryKey = 'attempt_id';

    protected $fillable = [
        'quiz_id',
        'student_id',
        'started_at',
        'submitted_at',
        'score',
        'total_points',
        'status',
        'violation_count',
    ];

    protected $casts = [
        'started_at'   => 'datetime',
        'submitted_at' => 'datetime',
    ];

    public function getPercentageAttribute()
    {
        return $this->total_points > 0 ? round($this->score / $this->total_points * 100) : 0;
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class, 'attempt_id');
    }

    public function violations()
    {
        return $this->hasMany(ViolationLog::class, 'attempt_id');
    }
}
