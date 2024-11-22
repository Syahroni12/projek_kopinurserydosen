<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Amonia;
use App\Models\Control_State;
use App\Models\Dioksida;
use App\Models\Humidity;
use App\Models\Metana;
use App\Models\Temperature;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $humidity = Humidity::where('id_alat', $request->id)
            ->offset(0)
            ->limit(1)
            ->orderBy('id_humidity', 'desc')
            ->get();
        $temperature = Temperature::where('id_alat', $request->id)
            ->offset(0)
            ->limit(1)
            ->orderBy('id_temperature', 'desc')
            ->get();

        $amonia = Amonia::where('id_alat', $request->id)
            ->offset(0)
            ->limit(1)
            ->orderBy('id_amonia', 'desc')
            ->get();

        return response()->json([ 'humidity' => $humidity, 'Temperature' => $temperature,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function control_statee()
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

            return response()->json(['Data pompa berhasil di hidupkan', 'status' => $status->control_value]);
        } else {
            // return redirect()->back()->with('success', ' Pompa dinonaktifkan!');
            return response()->json(['Data pompa berhasil di matikan', 'status' => $status->control_value]);
            # code...
        }

        // return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
