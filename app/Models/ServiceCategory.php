<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    public $timestamps = false;
  
    protected $fillable = [
        'name',
        'service_type_id',
    ];

    public function service_type(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
