<?php

namespace App;

use DateTime;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class Avatar
{


    /**
     * @param $fileName
     * @return string
     */
    public static function resize($fileName)
    {
        $img = Image::make($fileName);
        $width = null;
        $height = 200;

        if ($img->width() > $img->height()) {
            $width = 200;
            $height = null;
        }

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($fileName);
        return $fileName;
    }

    /**
     * @param $file
     * @return string
     */
    protected static function createUniqueFileName($file): string
    {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $ext = $file->getClientOriginalExtension();
        $fileName = $timestamp . "_" . $file->getClientOriginalName();
        $fileName = Str::slug($fileName, '-') . "." . $ext;
        return $fileName;
    }

}