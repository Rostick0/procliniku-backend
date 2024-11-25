<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\ShowImageRequest;
use App\Models\Image;
use App\Http\Requests\Image\StoreImageRequest;
use App\Utils\ImageUploadUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Symfony\Component\HttpFoundation\JsonResponse;


class ImageController extends Controller
{
    public function index() {}

    public function store(StoreImageRequest $request): JsonResponse
    {
        $image = $request->file('image');

        try {
            [$random_name, $width, $height] = ImageUploadUtil::make($image->path());

            $data = Image::create([
                'name' =>  $image->getClientOriginalName(),
                'width' => $width,
                'height' => $height,
                'path' => config()->get('app.url') . '/storage-custom/' . $random_name . 'jpeg',
                'path_webp' => config()->get('app.url') . '/storage-custom/' . $random_name . 'webp',
                'user_id' => auth()->id(),
            ]);

            return new JsonResponse([
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Loading error, try a smaller image',
                'd' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowImageRequest $request, int $id)
    {
        $img = Storage::get(
            Image::findOrFail($id)->path
        );

        $image = ImageManagerStatic::make($img);

        $image->resize($request?->w ?? $image->width(), $request->h ?? $image->height());

        return $image->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $image = Image::findOrFail($id);

        if (!auth()->check() || auth()?->user()?->cannot('delete', $image)) return new JsonResponse([
            'message' => 'No access'
        ], 403);

        Image::destroy($id);

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}
