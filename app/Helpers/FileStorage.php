<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileStorage
{
    public static function storeImageFromUpload($file)
    {
        $filePath =  Storage::put("public/product-images", $file);
        $url = Storage::url($filePath);
        return $url;
    }
}
