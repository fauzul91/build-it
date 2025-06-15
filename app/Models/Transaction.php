<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'status',
        'course_price',
        'payment_url',
    ];
}
