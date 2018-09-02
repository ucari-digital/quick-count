<?php
namespace App\Helper;
use Auth;
use Carbon\Carbon;
class Lib
{
	static function hex2rgb($hex, $alpha = 1) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return 'rgba('.implode(",", $rgb).','.$alpha.');'; // returns the rgb values separated by commas
		// return $rgb; // returns an array with the rgb values
	}

	static function array2string($array, $string = false)
	{
		$text = ',';
		foreach ($array as $item) {
			if ($string == false) {
				$text = $text.','.$item;
			} else if($string == true){
				$text = $text.','."'".$item."'";
			}
		}
		return str_replace(',,', '', '['.$text.']');
	}

	static function auth()
	{
		return Auth::guard('anggota')->user();
	}

	static function translatePosisi($posisi){
		$data = $posisi;
		if ($posisi == 'kabkota') {
			$data = 'Kab / Kota';
		}

		if ($posisi == 'relawan_ring1') {
			$data = 'Ring I';
		}

		if ($posisi == 'relawan_ring2') {
			$data = "Ring II";
		}

		return $data;
	}
}