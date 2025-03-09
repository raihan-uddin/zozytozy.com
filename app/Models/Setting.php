<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type'];

    public function scopeKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeKeyAndType($query, $key, $type)
    {
        return $query->where('key', $key)->where('type', $type);
    }

    public function scopeTypeKey($query, $type, $key)
    {
        return $query->where('type', $type)->where('key', $key);
    }

    public function scopeTypeAndKey($query, $type, $key)
    {
        return $query->where('type', $type)->where('key', $key);
    }

    public function scopeTypeKeyAndValue($query, $type, $key, $value)
    {
        return $query->where('type', $type)->where('key', $key)->where('value', $value);
    }

    public function scopeTypeAndKeyAndValue($query, $type, $key, $value)
    {
        return $query->where('type', $type)->where('key', $key)->where('value', $value);
    }
}
