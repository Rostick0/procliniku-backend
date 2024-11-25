<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class ImageUploadUtil
{
    public static function make($image)
    {
        $image_temp = ImageManagerStatic::make($image);
        [$width, $height] = getimagesize($image);

        $date = Carbon::now();

        // получение типа файла
        $extension = str_replace('image/', '', $image_temp->mime());
        $dir = 'upload/image/';
        $random_name = $dir . $date->format('Y/m/d') . '/' . random_int(1000, 9999) . time() . '.';
        $random_name_with_extension = 'public/' . $random_name . $extension;

        Storage::makeDirectory('public/' . $dir . $date->format('Y'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m/d'));

        // уменьшение размера фото, если оно больше, чем 1280 пикселей по ширине или высоте
        if ($width > 1280) {
            $width = 1280;
            $image_temp->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($height > 1280) {
            $height = 1280;
            $image_temp->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $storage_path = Storage::path($random_name_with_extension);
        $image_temp->save($storage_path);

        if ($extension !== 'webp') {
            ImageManagerStatic::make($storage_path)->encode('webp')->save(Storage::path('public/' . $random_name . 'webp'));
        }
        if ($extension !== 'jpeg') {
            ImageManagerStatic::make($storage_path)->encode('jpeg')->save(Storage::path('public/' . $random_name . 'jpeg'));
        }
        // удаление файла, если его тип не webp или не jpeg
        if (!in_array($extension, ['webp', 'jpeg'])) {
            Storage::delete($random_name_with_extension);
        }

        // возвращение имени, ширины, высоты
        return [$random_name, $width, $height];
    }
}
