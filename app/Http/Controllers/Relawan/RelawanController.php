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

        // Mengambil jumlah pemilih laki2 dan perempuan

        $perempuan = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'pemilih')->where('jk', 'P')->count();
        $laki = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'pemilih')->where('jk', 'L')->count();
        // --------------------------------------------

        $pemilih = [
            'perempuan' => $perempuan,
            'laki' => $laki
        ];

        $daerah_counter = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'pemilih')->get();

        $data_daerah_dumperdata_daerah_dumper = [];
        foreach ($daerah_counter as $numb => $item) {
            $data_daerah_dumper[$item->kecamatan]['kecamatan'] = $item->kecamatan;
            $data_daerah_dumper[$item->kecamatan]['counter'][] = $numb;
        }

        $daerah = [];
        foreach ($data_daerah_dumper as $item) {
            $daerah['daerah'][] = $item['kecamatan'];
            $daerah['counter'][] = count($item['counter']);
        }

        // return $daerah;
        // return $data_daerah_dumper;

        return view('relawan.relawan', compact('data', 'total_pemilih', 'pemilih', 'daerah'));
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
        $provinsi = Provinsi::all();
    	return view('relawan.data-relawan', compact('data', 'kota', 'provinsi'));
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

    public function relawanSearch(Request $request)
    {
        // return $request;
        $auth = Lib::auth();
        $anggota = Anggota::when($request->nama, function($query) use ($request){
            return $query->where('name', 'like', '%'.$request->nama.'%');  
        })
        ->when($request->email, function($query) use ($request){
            return $query->where('email', 'like',  '%'.$request->email.'%');
        })
        ->when($request->jk, function($query) use ($request){
            return $query->where('jk', $request->jk);
        })
        ->when($request->provinsi, function($query) use ($request){
            return $query->where('provinsi', $request->provinsi);
        })
        ->when($request->kecamatan, function($query) use ($request){
            return $query->where('kecamatan', $request->kecamatan);
        })
        ->when($request->kabkota, function($query) use ($request){
            return $query->where('kabkota', $request->kabkota);
        })
        ->when($request->kelurahan, function($query) use ($request){
            return $query->where('kelurahan', $request->kelurahan);
        })
        ->when($request->rt, function($query) use ($request){
            return $query->where('rtrw', 'like', $request->rt.'%');
        })
        ->when($request->rw, function($query) use ($request){
            return $query->where('rtrw', 'like', '%'.$request->rw);
        })
        ->where('role', 'relawan')
        ->where('referred_by', $auth->anggota_id)
        ->where('group_id', $auth->group_id)
        ->get();


        if ($auth->role == 'superadmin') {
            $data_anggota = Anggota::where('posisi', 'relawan')->where('role', 'relawan')->get();
        } else {
            $data_anggota = $anggota;
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
        $provinsi = Provinsi::all();
        return view('relawan.data-relawan', compact('data', 'kota', 'provinsi'));
    }
}
