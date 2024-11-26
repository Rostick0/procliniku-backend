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
        if ($request->has('clinic_categories')) {
            $data->clinic_categories()->delete();

            $clinic_categories = array_map(
                fn($category_id) => ['category_id' => $category_id],
                QueryString::convertToArray($request->clinic_categories)
            );

            $data->clinic_categories()->createMany($clinic_categories);
        }

        if ($request->has('clinic_services')) {
            $data->clinic_services()->delete();

            $clinic_services = array_map(
                fn($service_id) => ['service_id' => $service_id],
                QueryString::convertToArray($request->clinic_services)
            );

            $data->clinic_services()->createMany($clinic_services);
        }

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
        $this->is_auth_id = true;
        $this->string_user_id = "owner_id";
    }
}
