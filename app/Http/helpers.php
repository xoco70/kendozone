<?php
use Illuminate\Support\Str;


/**
 * Set a flash message in the session.
 *
 * @param  string $message
 * @return void
 */
function flash($message = null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($message);
//    session()->flash($state, $message);
}

function isNullOrEmptyString($param)
{
    return (!isset($param) || $param == null || trim($param) === '');
}

function sanitize($string, $force_lowercase = true, $anal = false)
{
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
        "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
        "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

function isJapanese($lang)
{
    return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $lang);
}

function isKorean($lang)
{
    return preg_match('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $lang);
}

/**
 * Returns a Random String
 * @param $length
 * @return bool|string
 */
function generateRandomString($length)
{
    $fullString = md5(uniqid(rand(), true));
    return substr($fullString, 0, $length);
}

/**
 * Generate random password
 * @return string
 */
function generatePassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/**
 * Upload Pic
 * @param $data
 * @return array
 */
function uploadPic($data)
{
    $file = array_first($data, null);
    if ($file != null && $file->isValid()) {

        $destinationPath = config('constants.RELATIVE_AVATAR_PATH');
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $ext = $file->getClientOriginalExtension();
        $fileName = $timestamp . "_" . $file->getClientOriginalName();
        $fileName = Str::slug($fileName, '-') . "." . $ext;

        if (!$file->move($destinationPath, $fileName)) {
            flash()->error("La subida del archivo ha fallado, vuelve a subir su foto por favor");
            return $data;
        } else {
            $data['avatar'] = $fileName;
            // Redimension and pic
            $img = Image::make($destinationPath . $fileName);
            if ($img->width() > $img->height()) {
                $img->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save($destinationPath . $fileName);

            return $data;
        }
    }
    return $data;
}


