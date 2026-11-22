<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;         // table only has created_at no updated_at to evade error make it false

    protected $fillable = [
        'school_id_num',
        'role',
        'action',
        'description',
        'created_at'
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class, 'school_id_num', 'school_id_num');
    }

    // helper method. no need to code this again in other constructors
    public static function record($schoolIdNum, $role, $action, $description = null)
    {
        ActivityLog::create([
            'school_id_num' => $schoolIdNum,
            'role'          => $role,
            'action'        => $action,
            'description'   => $description,
            'created_at'    => now(),
        ]);
    }
}
