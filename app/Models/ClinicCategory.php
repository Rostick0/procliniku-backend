<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ClinicCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'category_id',
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
