<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends ApiController
{
    public function __construct()
    {
        $this->model = new Region;
    }
}
