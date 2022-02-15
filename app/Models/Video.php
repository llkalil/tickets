<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'url',
        'duration',
        'file_name',
        'mime_type',
        'size',
        'created_at',
        'updated_at',
    ];
}
