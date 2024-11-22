<?php

namespace App\Http\Controllers;

use App\Models\Amonia;
use App\Models\Control_State;
use App\Models\Dioksida;
use App\Models\Humidity;
use App\Models\Metana;
use App\Models\Settingotomatis;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        } else {
            return redirect()->back()->with('success', ' Pompa dinonaktifkan!');
            # code...
        }

        // return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }


    public function otomatis_suhulembab(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "temperature_awal" => "required",
            "temperature_akhir" => "required",
            "humidity_awal" => "required",
            "humidity_akhir" => "required",
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            return redirect()->back()->with('error', $messages);
        }

        $tipe = 'suhu';
        $data = [
            'temperature_awal' => $request->input('temperature_awal'),
            'temperature_akhir' => $request->input('temperature_akhir'),
            'humidity_awal' => $request->input('humidity_awal'),
            'humidity_akhir' => $request->input('humidity_akhir'),
            'waktu1_awal' => null,
            'waktu1_akhir' => null,
            'waktu2_awal' => null,
            'waktu2_akhir' => null,
            'tipe' => $tipe
        ];

        // Sesuaikan dengan logika Anda untuk tipe data

        // Update jika ada, atau buat baru jika tidak ada
        $setting = Settingotomatis::first() ?? new Settingotomatis();

        // Update data yang ditemukan atau diisi dengan data baru
        $setting->fill($data);
        $setting->save();
        return redirect()->back()->with('success', 'Data berhasil diupdate atau ditambahkan.');
    }

    public function otomatis_waktu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "waktu1_awal" => "required",
            "waktu1_akhir" => "required",
            "waktu2_awal" => "required",
            "waktu2_akhir" => "required",
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();

            return redirect()->back()->with('error', $messages);
        }

        $waktu_awal1 = $this->convertTo24HourFormat($request->input('waktu1_awal'));
        $waktu_akhir1 = $this->convertTo24HourFormat($request->input('waktu1_akhir'));
        $waktu_awal2 = $this->convertTo24HourFormat($request->input('waktu2_awal'));
        $waktu_akhir2 = $this->convertTo24HourFormat($request->input('waktu2_akhir'));
        $tipe = 'waktu';
        $data = [
            'temperature_awal' => null,
            'temperature_akhir' => null,
            'humidity_awal' => null,
            'humidity_akhir' => null,
            'waktu1_awal' => $waktu_awal1,
            'waktu1_akhir' => $waktu_akhir1,
            'waktu2_awal' => $waktu_awal2,
            'waktu2_akhir' => $waktu_akhir2,
            'tipe' => $tipe
        ];

        // Sesuaikan dengan logika Anda untuk tipe data
        $setting = Settingotomatis::first() ?? new Settingotomatis();

        // Update data yang ditemukan atau diisi dengan data baru
        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }
    public function convertTo24HourFormat($time)
    {
        // Pisahkan jam, menit, dan AM/PM
        list($hour, $minute, $ampm) = sscanf($time, "%d:%d %s");

        // Jika waktu di atas 12 (PM), tambahkan 12 jam
        if (strcasecmp($ampm, 'pm') == 0) {
            $hour += 12;
        }

        // Jika waktu adalah 12 AM (midnight), ubah menjadi 00 jam
        if ($hour == 12 && strcasecmp($ampm, 'am') == 0) {
            $hour = 0;
        }

        // Kembalikan waktu dalam format 24 jam
        return sprintf("%02d:%02d", $hour, $minute);
    }
}
