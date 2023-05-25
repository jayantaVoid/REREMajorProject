<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    protected $guarded = [];
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_tag');
    }
    public function question()
    {
<<<<<<< HEAD
    return $this->hasMany(Question::class);
}
=======
        return $this->hasMany(Question::class);
    }
>>>>>>> b4bc478dd82cbc823857c788c4f96f810387ef40
    public function level()
    {
        return $this->belongsTo(Level::class,'level_tag');
    }
}
