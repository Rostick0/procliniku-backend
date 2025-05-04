<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicWorker extends Model
{
    protected $fillable = [
        'clinic_id',
        'user_id',
        'role'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
