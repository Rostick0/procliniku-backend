<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    public function __construct()
    {
        $this->model = new Service;
        $this->store_request = new StoreServiceRequest;
        $this->update_request = new UpdateServiceRequest;
    }
}
