<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\DivisiJaringan;
class SettingController extends Controller
{
    public function divisiJaringan()
    {
    	return view('page.setting.divisi_jaringan');
    }

    public function divisiJaringanSubmit(Request $request)
    {
    	try {
    		$field = new DivisiJaringan;
    		$field->name = $request->name;
    		$field->save();
    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menambah divisi jaringan');
		} catch (\Exception $e) {
			return $e->getMessage();
		}	
    }

    public function edit($id)
    {
    	$data = DivisiJaringan::where('id', $id)->first();
    	return view('page.setting.divisi_jaringan', compact('data'));
    }

    public function delete($id)
    {
    	$data = DivisiJaringan::where('id', $id)->update([
    		'is_deleted' => 'true',
    	]);
    }
}
