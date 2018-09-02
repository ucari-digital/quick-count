<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helper\Lib;
use App\Model\Anggota;
use App\Model\QuicCount;
use App\Model\Kandidat;
class GSController extends Controller
{
    /**
     * Global Static Controller Class
     */
    public static function cityAvailabel()
    {
    	$city = [3275, 3276];
    	return $city;
    }
}
