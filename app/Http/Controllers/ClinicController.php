<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends ApiController
{
    public function __construct()
    {
        $this->model = new Clinic;
    }
}
