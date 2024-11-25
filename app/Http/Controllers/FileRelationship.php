<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FileRelationship extends Model
{
    use HasFactory;

    protected $table = 'file_rels';

    protected $fillable = [
        'file_id',
        'type'
    ];

    public function file_relable(): MorphTo
    {
        return $this->morphTo();
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
