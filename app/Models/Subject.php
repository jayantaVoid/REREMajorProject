<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    protected $guarded = [];

    protected $hidden = [
        'id',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function semester()
    {
        return $this->belongsToMany(Semester::class,'semester_subjects');
    }
    public function department()
    {
        return $this->belongsToMany(Department::class,'department_subjects');
    }
}
