<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends ApiController
{
    public function __construct()
    {
        $this->model = new ServiceCategory;
    }
}
