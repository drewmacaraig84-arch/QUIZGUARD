<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role',
        'school_id_num',
        'first_name',
        'middle_name',
        'last_name',
        'dwcc_email',
        'password_hash',
        'department',
        'section',
        'status',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function questionBanks()
    {
        return $this->hasMany(QuestionBank::class, 'teacher_id');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'student_id');
    }
}
