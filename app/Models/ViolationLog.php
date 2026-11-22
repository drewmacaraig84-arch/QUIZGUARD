<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationLog extends Model
{
    protected $table = 'violation_logs';
    protected $primaryKey = 'violation_id';

    protected $fillable = [
        'attempt_id',
        'violation_type',
        'occurred_at',
        'duration_seconds',
        'question_id',
    ];

    protected $casts = ['occurred_at' => 'datetime'];

    public function attempt()
    {
        return $this->belongsTo(Attempt::class, 'attempt_id');
    }
}
