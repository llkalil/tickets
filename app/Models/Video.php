<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'disk',
        'path',
        'thumb_path',
        'duration',
        'original_name',
        'mime_type',
        'size',
        'conversions',
        'conversions_disk',
        'converted_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'conversions' => 'array',
    ];
}
