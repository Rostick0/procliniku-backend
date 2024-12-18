<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends ApiController
{
    public function __construct()
    {
        $this->model = new ServiceType;
    }
}
