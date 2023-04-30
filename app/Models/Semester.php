<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $hidden = [
        'id',
    ];

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = ucwords($value);
    // }
    public function department()
    {
        return $this->belongsToMany(Department::class,'department_semesters');
    }
    public function subject()
    {
        return $this->belongsToMany(Subject::class,'semester_subjects');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'semester_users');
    }
}
