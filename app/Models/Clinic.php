<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'rating',
        'link',
        'link_name',
        'longitude',
        'latitude',
        'description',
        'owner_id'
    ];

    // protected function address(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => strtolower($value),
    //         set: fn(string $value) => strtoupper($value)
    //     );
    // }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function work_times()
    {
        return $this->hasMany(User::class);
    }

    public function clinic_categories()
    {
        return $this->hasMany(ClinicCategory::class);
    }

    public function clinic_services()
    {
        return $this->hasMany(ClinicService::class);
    }
}
