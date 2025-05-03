<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\ShowImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class StorageImageController extends Controller
{
    public function show(ShowImageRequest $request, ?string $year, ?string $month, ?string $day,  string $path)
    {
        $img = Storage::get("public/upload/image/$year/$month/$day/$path");

        if (!$img) abort(404);

        $image = ImageManagerStatic::make($img);

        if ($request->w) {
            $image->resize($request?->w, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($request->h) {
            $image->resize(null, $request->h, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize($request?->w ?? $image->width(), $request->h ?? $image->height());
        }


        return $image->response();
    }
}
