<?php

namespace App;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class Avatar
{
    /**
     * Upload Pic
     * @param $data
     * @return array
     */
    public static function uploadPic($data)
    {
        $file = array_first($data, null);
        if ($file != null && $file->isValid()) {
            $destinationPath = config('constants.RELATIVE_AVATAR_PATH');
            $fileName = self::createUniqueFileName($file);
            if (!$file->move($destinationPath, $fileName)) {
                echo "No se pudo mover";
                flash()->error("Upload error, please try again");
                return $data;
            }
            $data['avatar'] = $fileName;
            // Redimension and pic
            static::resizePicAndSave($destinationPath, $fileName);
            Auth::user()->avatar = $fileName;
            Auth::user()->save();
            return $data;


        }
        echo "File is not valid";
        return $data;
    }

    /**
     * @param $destinationPath
     * @param $fileName
     */
    public static function resizePicAndSave($destinationPath, $fileName)
    {
        $img = Image::make($destinationPath . $fileName);
        $width = null;
        $height = 200;

        if ($img->width() > $img->height()) {
            $width = 200;
            $height = null;
        }

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($destinationPath . $fileName);
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