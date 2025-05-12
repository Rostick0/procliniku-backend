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
        'icon_id',
        'link_vk',
        'link_videohost',
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
        return $this->clinic_categories()?->first()?->category;
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

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'icon_id');
    }

    public function images()
    {
        return $this->morphMany(ImageRelat::class, 'image_relatsable');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function reviews_card(): HasMany
    {
        return $this->reviews()->take(3);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function articles_card(): HasMany
    {
        return $this->articles()->take(3);
    }

    public function clinic_services(): HasMany
    {
        return $this->hasMany(ClinicService::class);
    }

    public function clinic_phones(): HasMany
    {
        return $this->hasMany(ClinicPhone::class);
    }

    public function clinic_workers(): HasMany
    {
        return $this->hasMany(ClinicWorker::class);
    }

    public function my_favorite()
    {
        return $this->hasOne(Favorite::class)->where('user_id', auth()->id());
    }
}
