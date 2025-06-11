<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorVerif extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'portofolio',
        'linkedin_url',
        'github_url',
        'status',
        'rejection_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
