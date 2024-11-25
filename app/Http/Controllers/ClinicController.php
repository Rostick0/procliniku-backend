<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\StoreClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends ApiController
{
    public function __construct()
    {
        $this->model = new Clinic;
        $this->store_request = new StoreClinicRequest;
        $this->update_request = new UpdateClinicRequest;
    }
}
