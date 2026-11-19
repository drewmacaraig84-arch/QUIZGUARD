<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $primaryKey = 'log_id';
    public $timestamps = false;         // table only has created_at no updated_at to evade error make it false

    protected $fillable = [
        'school_id_num',
        'role',
        'action',
        'description',
        'created_at'
    ];

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
