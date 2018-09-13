<?php

namespace App\Http\Controllers\Kordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;

use App\Helper\TimeFormat;
use App\Helper\Lib;
class PusatController extends Controller
{
        public function index()
    {
        $auth = Lib::auth();
    	$data_pusat = Anggota::where('group_id', $auth->group_id)->where('posisi', 'pusat')->get();
        $provinsi = Provinsi::all();
        $data = [];
        foreach ($data_pusat as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

    	return view('kordinator.pusat.pusat', compact('data', 'pusat', 'provinsi'));
    }

    public function create()
    {
    	$provinsi = Provinsi::all();
    	
        $kordinator_kota = Anggota::where('posisi', 'kabkota')->get();
    	return view('kordinator.pusat.add-pusat', compact('provinsi', 'kordinator_kota'));
    }

    public function submit(Request $request)
    {
    	try {
	    	$time = new TimeFormat;
			$ttl = $time->date($request->tgl_lahir)->toFormat('sys');
			$file = Storage::disk('public')->put('images/avatar', $request->foto);
			$file_name = Storage::url($file);

			$input = $request;
			$input['ttl'] = $request->tempat.','.$ttl;
			$input['posisi'] = 'pusat';
			$input['role'] = 'kordinator';
			$input['avatar'] = $file_name;
            $input['group_id'] = 'G'.rand(0000,9999);

	    	Anggota::store($input);

	    	return redirect('kordinator/pusat/create')
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
    	$kota = Kota::whereIn('id', [3275, 3276])->get();
    	$data = Anggota::where('anggota_id', $anggota_id)->first();
    	return view('kordinator.pusat.edit-pusat', compact('kota', 'data'));
    }

    public function update(Request $request, $anggota_id)
    {
    	try {
    		$anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
	    	$time = new TimeFormat;
			$ttl = $time->date($request->tgl_lahir)->toFormat('sys');


			$input = $request;
			$input['ttl'] = $request->tempat.','.$ttl;
			$input['posisi'] = 'pusat';
			$input['role'] = 'kordinator';
            $input['referred_by'] = $anggota_data->referred_by;

			if (empty($request->foto)) {
				$input['avatar'] = $anggota_data->foto;
			} else {
				$file = Storage::disk('public')->put('images/avatar', $request->foto);
				$file_name = Storage::url($file);
				$input['avatar'] = $file_name;
			}

			if (empty($request->password)) {
				$input['password'] = $anggota_data->password;
			} else {
				$input['password'] = Hash::make($request->password);	
			}


			
	    	Anggota::commit($anggota_id, $input);

	    	return redirect('kordinator/pusat/edit/'.$anggota_id)
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mengubah data');
    	} catch (\Exception $e) {
    		return $e->getMessage();	
    	}
    }

    public function advSearch(Request $request)
    {
        $request['posisi'] = 'pusat';
        $data_kabkota = GSController::advancedSearch($request, 'kordinator');
        $provinsi = Provinsi::all();
        $data = [];
        foreach ($data_kabkota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        return view('kordinator.pusat.pusat', compact('data', 'provinsi'));
    }
}
