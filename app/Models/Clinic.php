<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Clinic extends Model
{
    /** @use HasFactory<\Database\Factories\ClinicFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'rating',
        'link',
        'link_name',
        'longitude',
        'latitude',
        'description',
        'is_verification',
        'owner_id',
        'city_id',
    ];

    protected $appends = ['main_category'];

    // protected function address(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => strtolower($value),
    //         set: fn(string $value) => strtoupper($value)
    //     );
    // }

    public function getMainCategoryAttribute()
    {
        return $this->clinic_categories()->first()->category;
        // return $this->clinic_categories()->with('category')->first();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function work_times(): HasMany
    {
        return $this->hasMany(ClinicWorkTime::class);
    }

    public function clinic_categories(): HasMany
    {
        return $this->hasMany(ClinicCategory::class);
    }

    public function clinic_services(): HasMany
    {
        return $this->hasMany(ClinicService::class);
    }

    public function clinic_phones(): HasMany
    {
        return $this->hasMany(ClinicPhone::class);
    }

    public function my_favorite()
    {
        return $this->hasOne(Favorite::class)->where('user_id', auth()->id());
    }
}
