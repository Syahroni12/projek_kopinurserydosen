<?php

use App\Models\Alat;
use App\Models\Control_State;
use App\Models\Humidity;
use App\Models\Settingotomatis;
use App\Models\Temperature;
use App\Services\Otomatisasi;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule as FacadesSchedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

FacadesSchedule::call(new Otomatisasi)->everySecond();
