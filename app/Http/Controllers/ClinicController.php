<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\StoreClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filters\QueryString;

class ClinicController extends ApiController
{
    protected static function extendsMutation($data, $request)
    {

        if ($request->has('images')) {
            $data->images()->delete();

            $images = array_map(
                fn($image_id) => ['image_id' => $image_id],
                QueryString::convertToArray($request->images)
            );

            $data->images()->createMany($images);
        }
    }

    public function __construct()
    {
        $this->model = new Clinic;
        $this->store_request = new StoreClinicRequest;
        $this->update_request = new UpdateClinicRequest;
    }
}
