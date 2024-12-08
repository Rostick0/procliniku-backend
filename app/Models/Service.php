<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'service_category_id'
    ];

    public function service_category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function clinic_services(): HasMany
    {
        return $this->hasMany(ClinicService::class);
    }
}
