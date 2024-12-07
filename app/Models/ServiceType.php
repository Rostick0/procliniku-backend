<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function service_category(): HasMany
    {
        return $this->hasMany(ServiceCategory::class);
    }
}
