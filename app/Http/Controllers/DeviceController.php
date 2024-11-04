<?php

namespace App\Http\Controllers;

use App\Models\Amonia;
use App\Models\Control_State;
use App\Models\Dioksida;
use App\Models\Humidity;
use App\Models\Metana;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */






    public function temperature(Request $request)
    {
        try {
            $date = Carbon::now();
            $data =   Temperature::create([
                'id_alat' => $request->id_alat,
                'nilai_temperature' => $request->nilai,
                'created_at' => $date,
            ]);

            return response()->json(['Data Berhasil Ditambahkan', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json('Data Gagal Ditambahkan');
        }
    }

    public function humidity(Request $request)
    {
        try {
            $date = Carbon::now();
            $data =  Humidity::create([
                'id_alat' => $request->id_alat,
                'nilai_humidity' => $request->nilai,
                'created_at' => $date,
            ]);

            return response()->json(['Data Berhasil Ditambahkan', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json('Data Gagal Ditambahkan');
        }
    }


    public function control_state()
    {

        $status = Control_State::first();
        if ($status->control_value == 1) {

            $status->control_value = 0;
            $status->save();
        } else {
            // # code...
            $status->control_value = 1;
            $status->save();
        }
        if ($status->control_value == 1) {

            return redirect()->back()->with('success', ' Pompa diaktifkan!');
        }else {
            return redirect()->back()->with('success', ' Pompa dinonaktifkan!');
            # code...
        }

        // return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

}
