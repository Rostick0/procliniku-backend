<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
