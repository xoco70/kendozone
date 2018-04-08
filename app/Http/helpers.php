<?php


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


// DB Helper

function setFKCheckOff()
{
    switch (DB::getDriverName()) {
        case 'mysql':
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            break;
        case 'sqlite':
            DB::statement('PRAGMA foreign_keys = OFF');
            break;
    }
}

function setFKCheckOn()
{
    switch (DB::getDriverName()) {
        case 'mysql':
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            break;
        case 'sqlite':
            DB::statement('PRAGMA foreign_keys = ON');
            break;
    }
}

function internet_connected()
{
    $is_conn = false;
    $connected = @fsockopen("www.google.com", 443);
    if ($connected){
        $is_conn = true;
        fclose($connected);
    }
    return $is_conn;

}



