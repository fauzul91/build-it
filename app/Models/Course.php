<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'tutor_id',
        'price',
        'type',
        'status',
        'rejection_reason',
        'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function videos()
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function benefits()
    {
        return $this->hasMany(CourseBenefit::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}