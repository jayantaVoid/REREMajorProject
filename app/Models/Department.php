<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dept_no',
        'name',
        'hod',
        'status',
        'slug',
    ];
    protected $hidden = [
        'id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function getDeptIdAttribute($value)
    {
        $this->attributes['dept_no'] = 'PRk' . ($value);
    }
    // hasMany relationship with department and user
    // public function user()
    // {
    //     return $this->belongsToMany(user::class, 'user_departments');
    // }
    public function semester()
    {
        return $this->belongsToMany(Semester::class,'department_semesters');
    }
    public function subject()
    {
        return $this->belongsToMany(Subject::class,'department_subjects');
    }
}
