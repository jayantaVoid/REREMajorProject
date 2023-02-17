<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Auth\MustVerifyEmail;
use Webpatser\Uuid\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'name',
        'email',
        'password',
        'email_verified_at',
        'status',
        'is_block',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    // hasOne relationship with user and profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    // hasMany relationship with user and department
    // public function department()
    // {
    //     return $this->hasOne(Department::class, 'id','department_id');
    // }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // ManytoMany relationship with user and role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }


}
