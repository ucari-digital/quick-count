<?php

namespace App\Http\Controllers\Kordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\GSController;

use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Helper\TimeFormat;
use App\Helper\Lib;
class KordinatorController extends Controller
{
    public function kordinator()
    {
        $kabkota = Anggota::where('posisi', 'kabkota')->count();
        $kecamatan = Anggota::where('posisi', 'kecamatan')->count();
        $kelurahan = Anggota::where('posisi', 'kelurahan')->count();
        $saksi = Anggota::where('posisi', 'saksi')->count();
        $relawan = Anggota::where('posisi', 'relawan')->count();
    	return view('kordinator.kordinator', compact('kabkota', 'kecamatan', 'kelurahan', 'rtrw', 'saksi', 'relawan'));
    }

    public function kabkot()
    {
    	return view('kordinator.kabkota.kabkota');
    }

    public function downline($anggota_id)
    {
    	$anggota = Anggota::where('anggota_id', $anggota_id)->first();
        $data = Anggota::where('referred_by', $anggota_id)->where('role', 'kordinator')->get();
        return view('kordinator.downline', compact('data', 'anggota'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        return view('kordinator.add-kordinator', compact('provinsi'));
    }

    public function submit(Request $request)
    {
        try {
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');
            $file = Storage::disk('public')->put('images/avatar', $request->foto);
            $file_name = Storage::url($file);

            if ($request->posisi == 'pusat') {
                $posisi = 'kabkota';
            }

            if ($request->posisi == 'kabkota') {
                $posisi = 'kecamatan';
            }

            if ($request->posisi == 'kecamatan') {
                $posisi = 'kelurahan';
            }

            if ($request->posisi == 'kelurahan') {
                $posisi = 'rtrw';
            }

            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = $posisi;
            $input['role'] = 'kordinator';
            $input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;

            Anggota::store($input);

            return redirect('kordinator/kabkota/create')
            ->with('status', 'success')
            ->with('message', 'Berhasil mendaftarkan anggota');
        } catch (\Exception $e) {
            
        }
    }
}