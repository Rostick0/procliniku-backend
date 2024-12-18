<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileUploadUtil
{
    public static function make($file)
    {
        $extension = $file->getClientOriginalExtension();

        $date = Carbon::now();

        $dir = 'upload/file/';
        $random_name = $dir . $date->format('Y/m/d') . '/' . random_int(1000, 9999) . time() . '.' . $extension;
        $random_name_with_extension = 'public/' . $random_name;

        Storage::makeDirectory('public/' . $dir . $date->format('Y'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m'));
        Storage::makeDirectory('public/' . $dir . $date->format('Y/m/d'));

        $file->storeAs($random_name_with_extension);

        return $random_name;
    }
}
