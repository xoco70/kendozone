<?php



function getIP()
{
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

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

function isNullOrEmptyString($question)
{
    return (!isset($question) || trim($question) === '');
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
//	 function menus( $position ='top',$active = '1')
//	{
//		$data = array();
//		$menu = self::nestedMenu(0,$position ,$active);
//		foreach ($menu as $row)
//		{
//			$child_level = array();
//			$p = json_decode($row->access_data,true);
//
//
//			if($row->allow_guest == 1)
//			{
//				$is_allow = 1;
//			} else {
//				$is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
//			}
//			if($is_allow ==1)
//			{
//
//				$menus2 = self::nestedMenu($row->menu_id , $position ,$active );
//				if(count($menus2) > 0 )
//				{
//					$level2 = array();
//					foreach ($menus2 as $row2)
//					{
//						$p = json_decode($row2->access_data,true);
//						if($row2->allow_guest == 1)
//						{
//							$is_allow = 1;
//						} else {
//							$is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
//						}
//
//						if($is_allow ==1)
//						{
//
//							$menu2 = array(
//									'menu_id'		=> $row2->menu_id,
//									'module'		=> $row2->module,
//									'menu_type'		=> $row2->menu_type,
//									'url'			=> $row2->url,
//									'menu_name'		=> $row2->menu_name,
//									'menu_lang'		=> json_decode($row2->menu_lang,true),
//									'menu_icons'	=> $row2->menu_icons,
//									'childs'		=> array()
//								);
//
//							$menus3 = self::nestedMenu($row2->menu_id , $position , $active);
//							if(count($menus3) > 0 )
//							{
//								$child_level_3 = array();
//								foreach ($menus3 as $row3)
//								{
//									$p = json_decode($row3->access_data,true);
//									if($row3->allow_guest == 1)
//									{
//										$is_allow = 1;
//									} else {
//										$is_allow = (isset($p[Session::get('gid')]) && $p[Session::get('gid')] ? 1 : 0);
//									}
//									if($is_allow ==1)
//									{
//										$menu3 = array(
//												'menu_id'		=> $row3->menu_id,
//												'module'		=> $row3->module,
//												'menu_type'		=> $row3->menu_type,
//												'url'			=> $row3->url,
//												'menu_name'		=> $row3->menu_name,
//												'menu_lang'		=> json_decode($row3->menu_lang,true),
//												'menu_icons'	=> $row3->menu_icons,
//												'childs'		=> array()
//											);
//										$child_level_3[] = $menu3;
//									}
//								}
//								$menu2['childs'] = $child_level_3;
//							}
//							$level2[] = $menu2 ;
//						}
//
//					}
//					$child_level = $level2;
//
//				}
//
//				$level = array(
//						'menu_id'		=> $row->menu_id,
//						'module'		=> $row->module,
//						'menu_type'		=> $row->menu_type,
//						'url'			=> $row->url,
//						'menu_name'		=> $row->menu_name,
//						'menu_lang'		=> json_decode($row->menu_lang,true),
//						'menu_icons'	=> $row->menu_icons,
//						'childs'		=> $child_level
//					);
//
//				$data[] = $level;
//			}
//
//		}
//		//echo '<pre>';print_r($data); echo '</pre>'; exit;
//		return $data;
//	}
//
//	 function nestedMenu($parent=0,$position ='top',$active = '1')
//	{
//		$group_sql = " AND tb_menu_access.group_id ='".Session::get('gid')."' ";
//		$active 	=  ($active =='all' ? "" : "AND active ='1' ");
//		$Q = DB::select("
//		SELECT
//			tb_menu.*
//		FROM tb_menu WHERE parent_id ='". $parent ."' ".$active." AND position ='{$position}'
//		GROUP BY tb_menu.menu_id ORDER BY ordering
//		");
//		return $Q;
//	}
//
//	 function CF_encode_json($arr) {
//	  $str = json_encode( $arr );
//	  $enc = base64_encode($str );
//	  $enc = strtr( $enc, 'poligamI123456', '123456poligamI');
//	  return $enc;
//	}
//
//	 function CF_decode_json($str) {
//	  $dec = strtr( $str , '123456poligamI', 'poligamI123456');
//	  $dec = base64_decode( $dec );
//	  $obj = json_decode( $dec ,true);
//	  return $obj;
//	}
//
//
//	 function columnTable( $table )
//	{
//        $columns = array();
//	    foreach(DB::select("SHOW COLUMNS FROM $table") as $column)
//        {
//           //print_r($column);
//		    $columns[] = $column->Field;
//        }
//
//
//        return $columns;
//	}
//
//	 function encryptID($id,$decript=false,$pass='',$separator='-', & $data=array()) {
//		$pass = $pass?$pass:Config::get('app.key');
//		$pass2 = Config::get('app.url');;
//		$bignum = 200000000;
//		$multi1 = 500;
//		$multi2 = 50;
//		$saltnum = 10000000;
//		if($decript==false){
//			$strA = self::alphaid(($bignum+($id*$multi1)),0,0,$pass);
//			$strB = self::alphaid(($saltnum+($id*$multi2)),0,0,$pass2);
//			$out = $strA.$separator.$strB;
//		} else {
//			$pid = explode($separator,$id);
//
//
//		//    trace($pid);
//			$idA = (self::alphaid($pid[0],1,0,$pass)-$bignum)/$multi1;
//			$idB = (self::alphaid($pid[1],1,0,$pass2)-$saltnum)/$multi2;
//			$data['id A'] = $idA;
//			$data['id B'] = $idB;
//			$out = ($idA==$idB)?$idA:false;
//		}
//		return $out;
//	}
//
// function alphaID($in, $to_num = false, $pad_up = false, $passKey = null)
//{
//    $index = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
//    if ($passKey !== null) {
//        // Although this function's purpose is to just make the
//        // ID short - and not so much secure,
//        // with this patch by Simon Franz (http://blog.snaky.org/)
//        // you can optionally supply a password to make it harder
//        // to calculate the corresponding numeric ID
//
//        for ($n = 0; $n<strlen($index); $n++) {
//            $i[] = substr( $index,$n ,1);
//        }
//
//        $passhash = hash('sha256',$passKey);
//        $passhash = (strlen($passhash) < strlen($index))
//            ? hash('sha512',$passKey)
//            : $passhash;
//
//        for ($n=0; $n < strlen($index); $n++) {
//            $p[] =    substr($passhash, $n ,1);
//        }
//
//        array_multisort($p,    SORT_DESC, $i);
//        $index = implode($i);
//    }
//
//    $base    = strlen($index);
//
//    if ($to_num) {
//        // Digital number    <<--    alphabet letter code
//        $in    = strrev($in);
//        $out = 0;
//        $len = strlen($in) - 1;
//        for ($t = 0; $t <= $len; $t++) {
//            $bcpow = bcpow($base, $len - $t);
//            $out     = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
//        }
//
//        if (is_numeric($pad_up)) {
//            $pad_up--;
//            if ($pad_up > 0) {
//                $out -= pow($base, $pad_up);
//            }
//        }
//        $out = sprintf('%F', $out);
//        $out = substr($out, 0, strpos($out, '.'));
//    } else {
//        // Digital number    -->>    alphabet letter code
//        if (is_numeric($pad_up)) {
//            $pad_up--;
//            if ($pad_up > 0) {
//                $in += pow($base, $pad_up);
//            }
//        }
//
//        $out = "";
//        for ($t = floor(log($in, $base)); $t >= 0; $t--) {
//            $bcp = bcpow($base, $t);
//            $a     = floor($in / $bcp) % $base;
//            $out = $out . substr($index, $a, 1);
//            $in    = $in - ($a * $bcp);
//        }
//        $out = strrev($out); // reverse
//    }
//
//    return $out;
//}
//
//
//	 function toForm($forms,$layout)
//	{
//		$f = '';
//	//	echo '<pre>'; print_r($forms);echo '</pre>';
//		//usort($forms,"_sort");
//		$block = $layout['column'];
//		$format = $layout['format'];
//		$display = $layout['display'];
//		$title = explode(",",$layout['title']);
//
//		if($format =='tab')
//		{
//			$f .='<ul class="nav nav-tabs">';
//
//			for($i=0;$i<$block;$i++)
//			{
//				$active = ($i==0 ? 'active' : '');
//				$tit = (isset($title[$i]) ? $title[$i] : 'None');
//				$f .= '<li class="'.$active.'"><a href="#'.trim(str_replace(" ","",$tit)).'" data-toggle="tab">'.$tit.'</a></li>
//				';
//			}
//			$f .= '</ul>';
//		}
//
//		if($format =='tab') $f .= '<div class="tab-content">';
//		for($i=0;$i<$block;$i++)
//		{
//			if($block == 4) {
//				$class = 'col-md-3';
//			}  elseif( $block ==3 ) {
//				$class = 'col-md-4';
//			}  elseif( $block ==2 ) {
//				$class = 'col-md-6';
//			} else {
//				$class = 'col-md-12';
//			}
//
//			$tit = (isset($title[$i]) ? $title[$i] : 'None');
//			// Grid format
//			if($format == 'grid')
//			{
//				$f .= '<div class="'.$class.'">
//						<fieldset><legend> '.$tit.'</legend>
//				';
//			} else {
//				$active = ($i==0 ? 'active' : '');
//				$f .= '<div class="tab-pane m-t '.$active.'" id="'.trim(str_replace(" ","",$tit)).'">
//				';
//			}
//
//
//
//			$group = array();
//
//			foreach($forms as $form)
//			{
//				$tooltip =''; $required = ($form['required'] != '0' ? '<span class="asterix"> * </span>' : '');
//				if($form['view'] != 0)
//				{
//					if($form['field'] !='entry_by')
//					{
//						if(isset($form['option']['tooltip']) && $form['option']['tooltip'] !='')
//						$tooltip = '<a href="#" data-toggle="tooltip" placement="left" class="tips" title="'. $form['option']['tooltip'] .'"><i class="icon-question2"></i></a>';
//						$hidethis = ""; if($form['type'] =='hidden') $hidethis ='hidethis';
//						$inhide = ''; if(count($group) >1) $inhide ='inhide';
//						//$ebutton = ($form['type'] =='radio' || $form['option'] =='checkbox') ? "ebutton-radio" : "";
//						$show = '';
//						if($form['type'] =='hidden') $show = 'style="display:none;"';
//						if($form['form_group'] == $i)
//						{
//							if($display == 'horizontal')
//							{
//								$f .= '
//								  <div class="form-group '.$hidethis.' '.$inhide.'" '.$show .'>
//									<label for="'.$form['label'].'" class=" control-label col-md-4 text-left"> '.$form['label'].' '.$required.'</label>
//									<div class="col-md-6">
//									  '.self::formShow($form['type'],$form['field'],$form['required'],$form['option']).'
//									 </div>
//									 <div class="col-md-2">
//									 	'.$tooltip.'
//									 </div>
//								  </div> ';
//							} else {
//								$f .= '
//								  <div class="form-group '.$hidethis.' '.$inhide.'" '.$show .'>
//									<label for="ipt" class=" control-label "> '.$form['label'].'  '.$required.' '.$tooltip.' </label>
//									  '.self::formShow($form['type'],$form['field'],$form['required'],$form['option']).'
//								  </div> ';
//
//							}
//						}
//					}
//
//				}
//			}
//			if($format == 'grid') $f .='</fieldset>';
//			$f .= '
//			</div>
//
//			';
//		}
//
//		//echo '<pre>'; print_r($f);echo '</pre>'; exit;
//		return $f;
//
//	}
//	 function gridClass( $layout )
//	{
//		$column = $layout['column'];
//		$format = $layout['format'];
//
//		if($block == 4) {
//			$class = 'col-md-3';
//		}  elseif( $block ==3 ) {
//			$class = 'col-md-4';
//		}  elseif( $block ==2 ) {
//			$class = 'col-md-6';
//		} else {
//			$class = 'col-md-12';
//		}
//
//
//		if(format == 'tab')
//		{
//			$tag_open = '<div class="col-md-">';
//			$tag_close = '<div class="col-md-">';
//
//		}  elseif($layout['format'] == 'accordion'){
//
//		} else {
//			$tag_open = '<div class="col-md-">';
//			$tag_close = '</div>';
//		}
//
//
//		return $class;
//	}
//
//

//
//	 function toView( $grids )
//	{
//		$f = '';
//		foreach($grids as $grid)
//		{
//			if(isset($grid['conn']) && is_array($grid['conn']))
//			{
//				$conn = $grid['conn'];
//				//print_r($conn);exit;
//			} else {
//				$conn = array('valid'=>0,'db'=>'','key'=>'','display'=>'');
//			}
//
//			if($grid['detail'] =='1')
//			{
//				if($grid['attribute']['image']['active'] =='1')
//				{
//					$val = "{{ SiteHelpers::showUploadedFile(\$row->".$grid['field'].",'".$grid['attribute']['image']['path']."') }}";
//				} elseif($conn['valid'] ==1)  {
//					$arr = implode(':',$conn);
//					//$arg = "'".$arr['valid'].":".$arr['db'].":".$arr['key'].":".$arr['display']."'";
//					$val = "{{ SiteHelpers::gridDisplayView(\$row->".$grid['field'].",'".$grid['field']."','".$arr."') }}";
//				} else {
//					$val = "{{ \$row->".$grid['field']." }}";
//				}
//				$f .= "
//					<tr>
//						<td width='30%' class='label-view text-right'>".$grid['label']."</td>
//						<td>".$val." </td>
//
//					</tr>
//				";
//			}
//		}
//		return $f;
//	}
//
//	  function transForm( $field, $forms = array(),$bulk=false , $value ='')
//	{
//		$type = '';
//		$bulk = ($bulk == true ? '[]' : '');
//		$mandatory = '';
//		foreach($forms as $f)
//		{
//			if($f['field'] == $field && $f['search'] ==1)
//			{
//				$type = ($f['type'] !='file' ? $f['type'] : '');
//				$option = $f['option'];
//				$required = $f['required'];
//
//				if($required =='required') {
//					$mandatory = "data-parsley-required='true'";
//				} else if($required =='email') {
//					$mandatory = "data-parsley-type'='email' ";
//				} else if($required =='date') {
//					$mandatory = "data-parsley-required='true'";
//				} else if($required =='numeric') {
//					$mandatory = "data-parsley-type='number' ";
//				} else {
//					$mandatory = '';
//				}
//			}
//		}
//
//		switch($type)
//		{
//			default;
//				$form ='';
//				break;
//
//			case 'text';
//				$form = "<input  type='text' name='".$field."{$bulk}' class='form-control input-sm' $mandatory value='{$value}'/>";
//				break;
//
//			case 'text_date';
//				$form = "<input  type='text' name='$field{$bulk}' class='date form-control input-sm' $mandatory value='{$value}'/> ";
//				break;
//
//			case 'text_datetime';
//				$form = "<input  type='text' name='$field{$bulk}'  class='date form-control input-sm'  $mandatory value='{$value}'/> ";
//				break;
//
//			case 'select';
//
//
//				if($option['opt_type'] =='external')
//				{
//
//					$data = DB::table($option['lookup_table'])->get();
//					$opts = '';
//					foreach($data as $row):
//						$selected = '';
//						if($value == $row->$option['lookup_key']) $selected ='selected="selected"';
//						$fields = explode("|",$option['lookup_value']);
//						//print_r($fields);exit;
//						$val = "";
//						foreach($fields as $item=>$v)
//						{
//							if($v !="") $val .= $row->$v." " ;
//						}
//						$opts .= "<option $selected value='".$row->$option['lookup_key']."' $mandatory > ".$val." </option> ";
//					endforeach;
//
//				} else {
//					$opt = explode("|",$option['lookup_query']);
//					$opts = '';
//					for($i=0; $i<count($opt);$i++)
//					{
//						$selected = '';
//						if($value == ltrim(rtrim($opt[0]))) $selected ='selected="selected"';
//						$row =  explode(":",$opt[$i]);
//						$opts .= "<option $selected value ='".trim($row[0])."' > ".$row[1]." </option> ";
//					}
//
//				}
//				$form = "<select name='$field{$bulk}'  class='form-control' $mandatory >
//							<option value=''> -- Select  -- </option>
//							$opts
//						</select>";
//				break;
//
//			case 'radio';
//
//				$opt = explode("|",$option['lookup_query']);
//				$opts = '';
//				for($i=0; $i<count($opt);$i++)
//				{
//					$checked = '';
//					$row =  explode(":",$opt[$i]);
//					$opts .= "<option value ='".$row[0]."' > ".$row[1]." </option> ";
//				}
//				$form = "<select name='$field{$bulk}' class='form-control' $mandatory ><option value=''> -- Select  -- </option>$opts</select>";
//				break;
//
//		}
//
//		return $form;
//	}
//
//	 function viewColSpan( $grid )
//	{
//		$i =0;
//		foreach ($grid as $t):
//			if($t['view'] =='1') ++$i;
//		endforeach;
//		return $i;
//	}
//
//	 function blend($str,$data) {
//		$src = $rep = array();
//
//		foreach($data as $k=>$v){
//			$src[] = "{".$k."}";
//			$rep[] = $v;
//		}
//
//		if(is_array($str)){
//			foreach($str as $st ){
//				$res[] = trim(str_ireplace($src,$rep,$st));
//			}
//		} else {
//			$res = str_ireplace($src,$rep,$str);
//		}
//
//		return $res;
//
//	}
//
//	 function toJavascript( $forms , $app , $class )
//	{
//		$f = '';
//		foreach($forms as $form){
//			if($form['view'] != 0)
//			{
//				if(preg_match('/(select)/',$form['type']))
//				{
//					if($form['option']['opt_type'] == 'external')
//					{
//						$table 	=  $form['option']['lookup_table'] ;
//						$val 	=  $form['option']['lookup_value'];
//						$key 	=  $form['option']['lookup_key'];
//						$lookey = '';
//						if($form['option']['is_dependency']) $lookey .= $form['option']['lookup_dependency_key'] ;
//						$f .= self::createPreCombo( $form['field'] , $table , $key , $val ,$app, $class , $lookey  );
//
//					}
//
//				}
//
//			}
//
//		}
//		return $f;
//
//	}
//
//	 function createPreCombo( $field , $table , $key ,  $val ,$app ,$class ,$lookey = null)
//	{
//
//
//
//		$parent = null;
//		$parent_field = null;
//		if($lookey != null)
//		{
//			$parent = " parent: '#".$lookey."',";
//			$parent_field =  ":{$lookey}:";
//		}
//		$pre_jCombo = "
//		\$(\"#{$field}\").jCombo(\"{{ URL::to('{$class}/comboselect?filter={$table}:{$key}:{$val}') }}$parent_field\",
//		{ ".$parent." selected_value : '{{ \$row[\"{$field}\"] }}' });
//		";
//		return $pre_jCombo;
//	}


//	 function globalXssClean()
//	{
//	    // Recursive cleaning for array [] inputs, not just strings.
//	    $sanitized = static::arrayStripTags(Input::get());
//	    Input::merge($sanitized);
//	}
//
//	 function arrayStripTags($array)
//	{
//	    $result = array();
//
//	    foreach ($array as $key => $value) {
//	        // Don't allow tags on key either, maybe useful for dynamic forms.
//	        $key = strip_tags($key);
//
//	        // If the value is an array, we will just recurse back into the
//	        // function to keep stripping the tags out of the array,
//	        // otherwise we will set the stripped value.
//	        if (is_array($value)) {
//	            $result[$key] = static::arrayStripTags($value);
//	        } else {
//	            // I am using strip_tags(), you may use htmlentities(),
//	            // also I am doing trim() here, you may remove it, if you wish.
//	            $result[$key] = trim(strip_tags($value));
//	        }
//	    }
//
//	    return $result;
//	}
//
//	 function writeEncoder($val) {
//		return base64_encode($val);
//	}
//
//	 function readEncoder($val) {
//		return base64_decode($val);
//	}
//
//	 function gridDisplay($val , $field, $arr) {
//		if(isset($arr['valid']) && $arr['valid'] ==1)
//		{
//			$fields = str_replace("|",",",$arr['display']);
//			$Q = DB::select(" SELECT ".$fields." FROM ".$arr['db']." WHERE ".$arr['key']." = '".$val."' ");
//			if(count($Q) >= 1 )
//			{
//				$row = $Q[0];
//				$fields = explode("|",$arr['display']);
//				$v= '';
//				$v .= (isset($fields[0]) && $fields[0] !='' ?  $row->$fields[0].' ' : '');
//				$v .= (isset($fields[1]) && $fields[1] !=''  ? $row-> $fields[1].' ' : '');
//				$v .= (isset($fields[2]) && $fields[2] !=''  ? $row->$fields[2].' ' : '');
//
//
//				return $v;
//			} else {
//				return '';
//			}
//		} else {
//			return $val;
//		}
//	}
//	 function gridDisplayView($val , $field, $arr) {
//		$arr = explode(':',$arr);
//
//		if(isset($arr['0']) && $arr['0'] ==1)
//		{
//			$Q = DB::select(" SELECT ".str_replace("|",",",$arr['3'])." FROM ".$arr['1']." WHERE ".$arr['2']." = '".$val."' ");
//			if(count($Q) >= 1 )
//			{
//				$row = $Q[0];
//				$fields = explode("|",$arr['3']);
//				$v= '';
//				$v .= (isset($fields[0]) && $fields[0] !='' ?  $row->$fields[0].' ' : '');
//				$v .= (isset($fields[1]) && $fields[1] !=''  ? $row-> $fields[1].' ' : '');
//				$v .= (isset($fields[2]) && $fields[2] !=''  ? $row->$fields[2].' ' : '');
//				return $v;
//			} else {
//				return '';
//			}
//		} else {
//			return $val;
//		}
//	}


//	 function BBCode2Html($text) {
//
//		$emotion =  URL::to('sximo/js/plugins/markitup/images/emoticons/');
//
//		$text = trim($text);
//
//		// BBCode [code]
//		if (!function_exists('escape')) {
//			function escape($s) {
//				global $text;
//				$text = strip_tags($text);
//				$code = $s[1];
//				$code = htmlspecialchars($code);
//				$code = str_replace("[", "&#91;", $code);
//				$code = str_replace("]", "&#93;", $code);
//				return '<pre class="prettyprint linenums"><code>'.$code.'</code></pre>';
//			}
//		}
//		$text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ms', "escape", $text);
//
//		// Smileys to find...
//		$in = array( 	 ':)',
//						 ':D',
//						 ':o',
//						 ':p',
//						 ':(',
//						 ';)'
//		);
//		// And replace them by...
//		$out = array(	 '<img alt=":)" src="'.$emotion.'emoticon-happy.png" />',
//						 '<img alt=":D" src="'.$emotion.'emoticon-smile.png" />',
//						 '<img alt=":o" src="'.$emotion.'emoticon-surprised.png" />',
//						 '<img alt=":p" src="'.$emotion.'emoticon-tongue.png" />',
//						 '<img alt=":(" src="'.$emotion.'emoticon-unhappy.png" />',
//						 '<img alt=";)" src="'.$emotion.'emoticon-wink.png" />'
//		);
//		$text = str_replace($in, $out, $text);
//
//		// BBCode to find...
//		$in = array( 	 '/\[b\](.*?)\[\/b\]/ms',
//						 '/\[div\="?(.*?)"?](.*?)\[\/div\]/ms',
//						 '/\[i\](.*?)\[\/i\]/ms',
//						 '/\[u\](.*?)\[\/u\]/ms',
//						 '/\[img\](.*?)\[\/img\]/ms',
//						 '/\[email\](.*?)\[\/email\]/ms',
//						 '/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms',
//						 '/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
//						 '/\[color\="?(.*?)"?\](.*?)\[\/color\]/ms',
//						 '/\[quote](.*?)\[\/quote\]/ms',
//						 '/\[list\=(.*?)\](.*?)\[\/list\]/ms',
//						 '/\[list\](.*?)\[\/list\]/ms',
//						 '/\[\*\]\s?(.*?)\n/ms'
//		);
//		// And replace them by...
//		$out = array(	 '<strong>\1</strong>',
//						 '<div class="\1">\2</div>',
//						 '<em>\1</em>',
//						 '<u>\1</u>',
//						 '<img src="\1" alt="\1" />',
//						 '<a href="mailto:\1">\1</a>',
//						 '<a href="\1">\2</a>',
//						 '<span style="font-size:\1%">\2</span>',
//						 '<span style="color:\1">\2</span>',
//						 '<blockquote>\1</blockquote>',
//						 '<ol start="\1">\2</ol>',
//						 '<ul>\1</ul>',
//						 '<li>\1</li>'
//		);
//		$text = preg_replace($in, $out, $text);
//
//		// paragraphs
//		$text = str_replace("\r", "", $text);
//		$text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
//		$text = nl2br($text);
//
//		// clean some tags to remain strict
//		// not very elegant, but it works. No time to do better ;)
//		if (!function_exists('removeBr')) {
//			function removeBr($s) {
//				return str_replace("<br />", "", $s[0]);
//			}
//		}
//		$text = preg_replace_callback('/<pre>(.*?)<\/pre>/ms', "removeBr", $text);
//		$text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);
//
//		$text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "removeBr", $text);
//		$text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);
//
//		return $text;
//	}
//
//	 function seoUrl($str, $separator = 'dash', $lowercase = FALSE)
//	{
//		if ($separator == 'dash')
//		{
//			$search		= '_';
//			$replace	= '-';
//		}
//		else
//		{
//			$search		= '-';
//			$replace	= '_';
//		}
//
//		$trans = array(
//					'&\#\d+?;'				=> '',
//					'&\S+?;'				=> '',
//					'\s+'					=> $replace,
//					'[^a-z0-9\-\._]'		=> '',
//					$replace.'+'			=> $replace,
//					$replace.'$'			=> $replace,
//					'^'.$replace			=> $replace,
//					'\.+$'					=> ''
//			  );
//
//		$str = strip_tags($str);
//
//		foreach ($trans as $key => $val)
//		{
//			$str = preg_replace("#".$key."#i", $val, $str);
//		}
//
//		if ($lowercase === TRUE)
//		{
//			$str = strtolower($str);
//		}
//
//		return trim(stripslashes(strtolower($str)));
//	}
//
//
//	static function renderHtml( $html )
//	{
//
//		$html = preg_replace( '/(\.+\/)+uploads/Usi' , URL::to('uploads') ,  $html );
//	//	$content = str_replace($pattern , URL::to('').'/', $content );
//        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
//        $openedtags = $result[1];
//        #put all closed tags into an array
//        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
//        $closedtags = $result[1];
//        $len_opened = count ( $openedtags );
//        # all tags are closed
//        if( count ( $closedtags ) == $len_opened )
//        {
//       	 return $html;
//        }
//        $openedtags = array_reverse ( $openedtags );
//        # close tags
//        for( $i = 0; $i < $len_opened; $i++ )
//        {
//            if ( !in_array ( $openedtags[$i], $closedtags ) )
//            {
//            $html .= "</" . $openedtags[$i] . ">";
//            }
//            else
//            {
//            unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
//            }
//        }
//        return $html;
//
//
//
//	}
//

//	function initMarkitUp()
//	{
//		$html =  HTML::style('sximo/js/plugins/markitup/skins/simple/style.css');
//		$html .=  HTML::style('sximo/js/plugins/markitup/sets/default/style.css');
//		$html .=  HTML::script('sximo/js/plugins/markitup/jquery.markitup.js');
//		$html .=  HTML::script('sximo/js/plugins/markitup/sets/default/set.js');
//		return $html;
//
//	}


//
