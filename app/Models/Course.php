<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'teacher_id',
        'name',
        'description',
        'price_real',
        'price_market',
        'duration',
        'is_active',
        'is_draft',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function steps()
    {
        return $this->hasMany(CourseStep::class);
    }

    public function activeSteps()
    {
        return $this->hasMany(CourseStep::class)->where('is_active', true);
    }

    public function teacher()
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
}
