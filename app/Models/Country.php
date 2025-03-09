<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'iso_3166_2',
        'iso_3166_3',
        'iso_numeric',
        'currency_code',
        'currency_name',
        'currency_symbol',
        'flag',
        'status',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
