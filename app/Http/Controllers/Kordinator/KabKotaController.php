<?php

namespace App\Http\Controllers\Kordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\Model\Anggota;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
use App\Model\Provinsi;

use App\Helper\TimeFormat;
use App\Helper\Lib;
class KabKotaController extends Controller
{
    public function index(Request $request)
    {
    	$data_kabkota = Anggota::where('posisi', 'kabkota')->get();

        $data = [];
        foreach ($data_kabkota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        // return $data;

    	return view('kordinator.kabkota.kabkota', compact('data'));
    }

    public function create()
    {
    	$provinsi = Provinsi::all();

    	return view('kordinator.kabkota.add-kabkota', compact('provinsi'));
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
			$input['posisi'] = 'kabkota';
			$input['role'] = 'kordinator';
			$input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;

	    	Anggota::store($input);

	    	return redirect('kordinator/kabkota/create')
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
    	$provinsi = Provinsi::all();
    	$data = Anggota::where('anggota_id', $anggota_id)->first();
    	return view('kordinator.kabkota.edit-kabkota', compact('provinsi', 'data'));
    }

    public function update(Request $request, $anggota_id)
    {
    	try {
    		$anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
	    	$time = new TimeFormat;
			$ttl = $time->date($request->tgl_lahir)->toFormat('sys');


			$input = $request;
			$input['ttl'] = $request->tempat.','.$ttl;
			$input['posisi'] = 'kabkota';
			$input['role'] = 'kordinator';

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

	    	return redirect('kordinator/kabkota/edit/'.$anggota_id)
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();	
    	}
    }
}