<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->model = new Review;
    }
}