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

function showNotification()
{
    $status = Session::get('msgstatus');
    if (Session::has('msgstatus')): ?>
        <script type="text/javascript">
            $(document).ready(function () {
                toastr.<?php echo $status;?>("success", "<?php echo Session::get('messagetext');?>");
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-bottom-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"

                }
            });
        </script>
    <?php endif;
}

function alert($task, $message)
{
    if ($task == 'error') {
        $alert = '
			<div class="alert alert-danger  fade in block-inner">
				<button data-dismiss="alert" class="close" type="button"> x </button>
			<i class="icon-cancel-circle"></i> ' . $message . ' </div>
			';
    } elseif ($task == 'success') {
        $alert = '
			<div class="alert alert-success fade in block-inner">
				<button data-dismiss="alert" class="close" type="button"> x </button>
			<i class="icon-checkmark-circle"></i> ' . $message . ' </div>
			';
    } elseif ($task == 'warning') {
        $alert = '
			<div class="alert alert-warning fade in block-inner">
				<button data-dismiss="alert" class="close" type="button"> x </button>
			<i class="icon-warning"></i> ' . $message . ' </div>
			';
    } else {
        $alert = '
			<div class="alert alert-info  fade in block-inner">
				<button data-dismiss="alert" class="close" type="button"> x </button>
			<i class="icon-info"></i> ' . $message . ' </div>
			';
    }
    return $alert;

}

function _sort($a, $b)
{

    if ($a['sortlist'] == $a['sortlist']) {
        return strnatcmp($a['sortlist'], $b['sortlist']);
    }
    return strnatcmp($a['sortlist'], $b['sortlist']);
}


function cropImage($nw, $nh, $source, $stype, $dest)
{
    $size = getimagesize($source); // ukuran gambar
    $w = $size[0];
    $h = $size[1];
    switch ($stype) { // format gambar
        case 'gif':
            $simg = imagecreatefromgif($source);
            break;
        case 'jpg':
            $simg = imagecreatefromjpeg($source);
            break;
        case 'png':
            $simg = imagecreatefrompng($source);
            break;
    }
    $dimg = imagecreatetruecolor($nw, $nh); // menciptakan image baru
    $wm = $w / $nw;
    $hm = $h / $nh;
    $h_height = $nh / 2;
    $w_height = $nw / 2;
    if ($w > $h) {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h);
    } elseif (($w < $h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h);
    } else {
        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
    }
    imagejpeg($dimg, $dest, 100);
}


function showUploadedFile($file, $path, $width = 50)
{

    $files = public_path() . str_replace('.', '', $path) . $file;

//		if(file_exists('./'.$files ) && $file !="") {
    if (file_exists($files) && $file != "") {
        $info = pathinfo($files);
        if ($info['extension'] == "jpg" || $info['extension'] == "jpeg" || $info['extension'] == "png" || $info['extension'] == "gif") {
            $path_file = str_replace("./", "", $path);
            return '<p><a href="' . URL::to('') . $path_file . $file . '" target="_blank" class="previewImage">
				<img src="' . URL::to('') . $path_file . $file . '" border="0" width="' . $width . '" class="img-circle" /></a></p>';
        } else {
            $path_file = str_replace("./", "", $path);
            return '<p> <a href="' . URL::to($path_file . $file) . '" target="_blank"> ' . $file . ' </a>';
        }

    } else {
        $info = pathinfo($files);
        if (isset($info['extension'])) {
            if ($info['extension'] == "jpg" || $info['extension'] == "jpeg" || $info['extension'] == "png"
                || $info['extension'] == "gif"
            ) {
                $path_file = str_replace("./", "", $path);
                return "<img src='" . URL::to('') . "/images/avatar/avatar.png' border='0' width='" . $width . "' class='img-circle' /></a>";
            }
        } else {

        }
    }

}


function langOption()
{
    $lang = scandir(app_path() . '/lang/');
    $t = array();
    foreach ($lang as $value) {
        if ($value === '.' || $value === '..') {
            continue;
        }
        if (is_dir(app_path() . '/lang/' . $value)) {
            $fp = file_get_contents(app_path() . '/lang/' . $value . '/info.json');
            $fp = json_decode($fp, true);
            $t[] = $fp;
        }

    }
    return $t;
}


function themeOption()
{
    $lang = scandir(app_path() . '/views/layouts/');
    $t = array();
    foreach ($lang as $value) {
        if ($value === '.' || $value === '..') {
            continue;
        }
        if (is_dir(app_path() . '/views/layouts/' . $value)) {
            $fp = file_get_contents(app_path() . '/views/layouts/' . $value . '/info.json');
            $fp = json_decode($fp, true);
            $t[] = $fp;
        }

    }
    return $t;
}

function avatar($width = 75)
{
    $avatar = '<img alt="" src="http://www.gravatar.com/avatar/' . md5(Session::get('email')) . '" class="img-circle" width="' . $width . '" />';
    $Q = DB::table("tb_users")->where("id", '=', Session::get('uid'))->get();
    $row = $Q[0];
    $files = './uploads/users/' . $row->avatar;
    if ($row->avatar != '') {
        if (file_exists($files)) {
            return '<img src="' . URL::to('uploads/users') . '/' . $row->avatar . '" border="0" width="' . $width . '" class="img-circle" />';
        } else {
            return $avatar;
        }
    } else {
        return $avatar;
    }
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

