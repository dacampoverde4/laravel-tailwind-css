<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ImageHelper {

    public static function separateWordByLastDot($val)
    {
        $first_word='';
        $middle_word='';
        $last_word='';
        $arr=array();
        if($val!="")
        {
            $val_arr=explode('.',$val);
            if(count($val_arr)>1) {
                for ($i = 0; $i < count($val_arr); $i++) {
                    if($i==0)
                    {
                        $first_word=$val_arr[$i];
                    }
                    elseif ($i == count($val_arr) - 1) {
                        $last_word = $val_arr[$i];
                    }
                    else {
                        $middle_word .= $val_arr[$i] . '.';
                    }
                }
                $arr[]=$first_word;
                $arr[]=substr($middle_word,0,-1);
                $arr[]=$last_word;
            }
        }
        return $arr;
    }

	public function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }


    public function createUniqueFilename( $filename,$ext,$upload_path )
    {
        //$upload_path = env('UPLOAD_PATH');
        $full_image_path = $upload_path .'/'. $filename . '.'.$ext;

        if ( File::exists( $full_image_path ) )
        {
            //echo "file exists\n";
            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $image_token;
        }
        else{
            //echo "file not exists\n";
        }

        return $filename;
    }


    public static function getImageNameWithoutExtension($image_name){

        $separate_name_by_dot_arr=ImageHelper::separateWordByLastDot($image_name);

		$image_name_without_extension=$separate_name_by_dot_arr[0];
		if($separate_name_by_dot_arr[1]!="")
			$image_name_without_extension.='.'.$separate_name_by_dot_arr[1];

		return $image_name_without_extension;
    }


    public static function getImageExtension($image_name){

        $separate_name_by_dot_arr=ImageHelper::separateWordByLastDot($image_name);

		return $separate_name_by_dot_arr[2];
    }


	public function aspectratio($a, $b)
	{
		# sanity check
		if ($a <= 0 || $b <= 0)
		{
			return array(0, 0);
		}
		$total = $a + $b;
		for ($i = 1; $i <= 40; $i++)
		{
			$arx = $i * 1.0 * $a / $total;
			$brx = $i * 1.0 * $b / $total;
			if ($i == 40 || (abs($arx - round($arx)) <= 0.02 && abs($brx - round($brx)) <= 0.02))
			{
				# Accept aspect ratios within a given tolerance
				return array(round($arx), round($brx));
			}
		}
	}


}