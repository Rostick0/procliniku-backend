<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends ApiController
{
    public function __construct()
    {
        $this->model = new Appointment;
    }
}
