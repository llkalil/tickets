<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'value_real',
        'value_total',
        'value_comission',
        'is_paid',
        'payment_method',
        'paid_at',
    ];

}
