<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
