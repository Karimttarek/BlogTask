<?php

namespace Modules\Dashboard\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;

Trait Helper
{
    public static function uploadimage($file , $filename , $path){

        $f = $file;
        $fn = $filename;
        $file->move($path , $fn);
    }

    public static function deleteimage($path){

        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
