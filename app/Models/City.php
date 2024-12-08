<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'region_id'
    ];

    public function region()
    {
        return $this->belongsTo(City::class);
    }
}
