<?php

namespace App\Http\Controllers\Relawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GSController;
use Hash;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;

use App\Helper\TimeFormat;
use App\Helper\Lib;
class RelawanController extends Controller
{
    public function relawan()
    {
        $data = Anggota::where('referred_by', Lib::auth()->anggota_id)->where('role', 'relawan')->count();
        $total_pemilih  = Anggota::where('role', 'pemilih')->count();
        return view('relawan.relawan', compact('data', 'total_pemilih'));
    }

    public function index(Request $request)
    {
        $auth = Lib::auth();

        if ($auth->role == 'superadmin') {
            $data_anggota = Anggota::where('posisi', 'relawan')->where('role', 'relawan')->get();
        } else {
            $data_anggota = Anggota::where('referred_by', $auth->anggota_id)->where('role', 'relawan')->get();
        }

        if ($request->saksi) {
            $data_anggota = Anggota::where('posisi', 'saksi')
            ->where('group_id', Lib::auth()->group_id)
            ->where('role', 'relawan')
            ->get();
        }

        $data = [];
        foreach ($data_anggota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'pemilih')->count();
        }
        $kota = Kota::whereIn('id', GSController::cityAvailabel())->get();
    	return view('relawan.data-relawan', compact('data', 'kota'));
    }

    public function create()
    {
    	$provinsi = Provinsi::all();
    	return view('relawan.add-relawan', compact('provinsi'));
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
			$input['posisi'] = 'relawan';
			$input['role'] = 'relawan';
			$input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;

	    	Anggota::store($input);

	    	return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
        $kota = Kota::whereIn('id', GSController::cityAvailabel())->get();
        $data = Anggota::where('anggota_id', $anggota_id)->first();
        return view('relawan.edit-relawan', compact('kota', 'data'));
    }

    public function update(Request $request, $anggota_id)
    {
        try {
            $anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');


            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = 'relawan';
            $input['role'] = 'relawan';
            $input['referred_by'] = $anggota_data->referred_by;

            if (empty($request->foto)) {
                $input['avatar'] = $anggota_data->foto;
            } else {
                $file = Storage::disk('public')->put('images/avatar', $request->foto);
                $file_name = Storage::url($file);
                $input['avatar'] = $file_name;
            }

            if (empty($request->foto_ktp)) {
                $input['fktp'] = $anggota_data->foto_ktp;
            } else {
                $foto_ktp = Storage::disk('public')->put('images/ktp', $request->foto_ktp);
                $foto_name_ktp = Storage::url($foto_ktp);
                $input['fktp'] = $foto_name_ktp;
            }

            if (empty($request->password)) {
                $input['password'] = $anggota_data->password;
            } else {
                $input['password'] = Hash::make($request->password);    
            }


            
            Anggota::commit($anggota_id, $input);

            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Berhasil mendaftarkan anggota');
        } catch (\Exception $e) {
            return $e->getMessage();    
        }
    }
}
