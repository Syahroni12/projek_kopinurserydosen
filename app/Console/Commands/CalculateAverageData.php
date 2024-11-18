<?php

namespace App\Console\Commands;

use App\Models\Alat;
use App\Models\Control_State;
use App\Models\Humidity;
use App\Models\Temperature;
use Illuminate\Console\Command;

class CalculateAverageData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-average-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $alat = Alat::where('id_alat', '<', 7)->get();
        $totalHumidity = 0;
        $totalTemperature = 0;
        $count = 0;

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

            $status = Control_State::first();
            // Mengecek kondisi berdasarkan rata-rata
            if (($averageTemperature < 23 || $averageTemperature > 26) || $averageHumidity < 60) {

                $status->control_value = 1;
                $status->save();

                // Tambahkan aksi lain di sini jika dibutuhkan, misalnya mengirim notifikasi.
            }else {

                $status->control_value = 0;
                $status->save();

            }


        } else {
            return [
                'averageHumidity' => null,
                'averageTemperature' => null,
            ];
        }
    }
}
