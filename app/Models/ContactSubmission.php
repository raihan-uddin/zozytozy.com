<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'email',
        'phone_code',
        'phone',
        'company_name',
        'company_address',
        'best_time',
    ];

    protected $casts = [
        'best_time' => 'array',
    ];

    public function getBestTimeFormattedAttribute()
    {
        $bestTime = $this->best_time ? json_decode($this->best_time, true) : [];

        return $bestTime ? implode(', ', $bestTime) : 'N/A';
    }
}
