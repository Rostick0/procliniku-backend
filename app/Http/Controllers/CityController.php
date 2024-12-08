<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function __construct()
    {
        $this->model = new City;
    }
}
