<?php
namespace App\Services;
use App\Models\Settingotomatis;
use Illuminate\Support\Facades\DB;
use App\Models\Alat;
use App\Models\Control_State;
use App\Models\Humidity;

use App\Models\Temperature;
use Carbon\Carbon;
class Otomatisasi{
public function __invoke()
{
    $alat = Alat::where('id_alat', '<', 7)->get();
    $totalHumidity = 0;
    $totalTemperature = 0;
    $count = 0;


    $otomatis = Settingotomatis::first();
    $status = Control_State::first();
    $currentTime = Carbon::now();
    $sekarang = $currentTime->format('H:i:s');
    if ($otomatis) {
        if ($otomatis->tipe == 'suhu') {
            foreach ($alat as $value) {
                $latestHumidity = Humidity::where('id_alat', $value->id_alat)->latest()->first();
                $latestTemperature = Temperature::where('id_alat', $value->id_alat)->latest()->first();

                if ($latestHumidity && $latestTemperature) {
                    $totalHumidity += $latestHumidity->value;
                    $totalTemperature += $latestTemperature->value;
                    $count++;
                }
            }

            if ($count > 0) {
                $averageHumidity = $totalHumidity / $count;
                $averageTemperature = $totalTemperature / $count;


                // Mengecek kondisi berdasarkan rata-rata
                if (
                    ($averageTemperature > $otomatis->temperature_awal && $averageTemperature < $otomatis->temperature_akhir) ||
                    ($averageHumidity > $otomatis->humidity_awal && $averageHumidity < $otomatis->humidity_akhir)
                ) {
                    $status->control_value = 1;
                    $status->save();

                    // Tambahkan aksi lain di sini jika dibutuhkan, misalnya mengirim notifikasi.
                } else {

                    $status->control_value = 0;
                    $status->save();
                }
            } else {
                return [
                    'averageHumidity' => null,
                    'averageTemperature' => null,
                ];
            }
        } else {
            if ((($currentTime->between($otomatis->waktu1_awal, $otomatis->waktu1_akhir)) || ($currentTime->between($otomatis->waktu2_awal, $otomatis->waktu2_akhir)))) {
                $status->control_value = 1;
                $status->save();
            } else {
                $status->control_value = 0;
                $status->save();
            }
        }

        # code...
    }
}
}
