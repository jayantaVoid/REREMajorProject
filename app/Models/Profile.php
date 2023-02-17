<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'blood_group',
        'gender',
        'religion',
        'dob',
        'picture',
        'city',
        'state',
        'zip_code',
        'country',
        'isGeneral',
        'isHod',
        'qualification',
        'joining_date',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getDobAttribute($value)
    {
        return date("d-M-Y", strtotime($value));
    }
}
