<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'width',
        'height',
        'path',
        'path_webp',
        'user_id',
    ];

    // protected $hidden = [
    //     'updated_at'
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
