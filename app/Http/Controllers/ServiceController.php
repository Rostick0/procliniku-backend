<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    public function __construct()
    {
        $this->model = new Service;
    }
}
