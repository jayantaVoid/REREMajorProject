<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_name',
        'slug',
        'status',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'user_roles');
    }
}
