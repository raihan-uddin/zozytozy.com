<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'country_id',
        'state',
        'tax_rate',
        'delivery_fee',
        'status',
        'city',
        'county',
        'zip_code',
        'latitude',
        'longitude',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeActive($query){
        return $query->where('status', 'active');
    }

    public function scopeOrderByState($query){
        return $query->orderBy('state', 'asc');
    }
}
