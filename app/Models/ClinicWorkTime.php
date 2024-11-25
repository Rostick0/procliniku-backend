<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicWorkTime extends Model
{
    protected $fillable = [
        'day',
        'time_start',
        'time_end',
        'clinic_id',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
