<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')

    <style>
        .progress-container {
            position: relative;
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, red, yellow, green);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .progress-bar-fill {
            height: 100%;
            width: 0;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .progress-needle {
            position: absolute;
            top: -10px;
            width: 2px;
            height: 40px;
            background: black;
            transition: left 0.5s;
        }

        .bg-brown {
            background-color: #A0522D;
            /* Kode HEX warna coklat */
        }
    </style>

</head>

<body class="flex flex-col h-screen">
    <div class="flex h-screen">
        @livewire('partials.sidebar')
        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @livewire('partials.header')

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4">
                <div class="gap-4">
                    <div class="bg-white shadow-lg rounded-lg mb-4">
                        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <h6 class="m-0 font-semibold text-gray-700">Dashboard</h6>
                        </div>
                        <div class="px-8 py-8">
                            <div class="grid grid-cols-2 gap-4">
                                <a href="{{ route('detail.dashboard1', ['id' => 1]) }}" class="col-span-1">
                                    <div class="bg-brown h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
                                        <div class="w-full mb-6 items-center mt-4">
                                            <p class="text-white text-lg font-bold">Lokasi Alat 1</p>
                                            <p class="text-white text-sm font-bold">Keterangan Lokasi:</p>
                                        </div>
                                        <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Suhu</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Temperature1->isNotEmpty())
                                                        @foreach ($Temperature1 as $temperature)
                                                        {{ $temperature->nilai_suhu }} C
                                                        @endforeach
                                                        @else
                                                    <p class="text-red-500">No Temperature data available.</p>
                                                    @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Kelembapan</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Humidity1->isNotEmpty())
                                                        @foreach ($Humidity1 as $humidity)
                                                        {{ $humidity->nilai_humidity }} %
                                                        @endforeach
                                                        @else
                                                    <p class="text-red-500">No Humidity data available.</p>
                                                    @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Ammonia</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Amonia1->isNotEmpty())
                                                            @foreach ($Amonia1 as $amonia)
                                                                {{ $amonia->nilai_amonia }}
                                        @endforeach
                                        @else
                                        <p class="text-red-500">No Ammonia data available.</p>
                                        @endif
                                        </p>
                                    </div>
                            </div>
                        </div> --}}
                        {{-- <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Karbon Dioksida</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Dioksida1->isNotEmpty())
                                                            @foreach ($Dioksida1 as $dioksida)
                                                                {{ $dioksida->nilai_dioksida }}
                        @endforeach
                        @else
                        <p class="text-red-500">No Dioksida data available.</p>
                        @endif
                        </p>
                    </div>
                </div>
        </div> --}}

    </div>
    </a>
    <a href="{{ route('detail.dashboard2', ['id' => 2]) }}" class="col-span-1">
        <div
            class="bg-brown h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
            <div class="w-full mb-6 items-center mt-4">
                <p class="text-white text-lg font-bold">Lokasi Alat 2</p>
                <p class="text-white text-sm font-bold">Keterangan Lokasi:</p>
            </div>
            <div class="w-full mb-6">
                <div class="flex justify-between">
                    <div class="flex w-full">
                        <p class="text-white text-md font-bold w-1/3">Suhu</p>
                        <p class="text-white text-md font-bold w-1/6">:</p>
                        <p class="text-white text-md font-bold w-1/2">
                            @if ($Temperature2->isNotEmpty())
                            @foreach ($Temperature2 as $temperature)
                            {{ $temperature->nilai_suhu }} C
                            @endforeach
                            @else
                        <p class="text-red-500">No Temperature data available.</p>
                        @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full mb-6">
                <div class="flex justify-between">
                    <div class="flex w-full">
                        <p class="text-white text-md font-bold w-1/3">Kelembapan</p>
                        <p class="text-white text-md font-bold w-1/6">:</p>
                        <p class="text-white text-md font-bold w-1/2">
                            @if ($Humidity2->isNotEmpty())
                            @foreach ($Humidity2 as $humidity)
                            {{ $humidity->nilai_humidity }} %
                            @endforeach
                            @else
                        <p class="text-red-500">No Humidity data available.</p>
                        @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Karbon Dioksida</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Dioksida2->isNotEmpty())
                                                            @foreach ($Dioksida2 as $dioksida)
                                                                {{ $dioksida->nilai_dioksida }}
            @endforeach
            @else
            <p class="text-red-500">No Dioksida data available.</p>
            @endif
            </p>
        </div>
        </div>
        </div> --}}
        {{-- <div class="w-full mb-6">
                                            <div class="flex justify-between">
                                                <div class="flex w-full">
                                                    <p class="text-white text-md font-bold w-1/3">Metana</p>
                                                    <p class="text-white text-md font-bold w-1/6">:</p>
                                                    <p class="text-white text-md font-bold w-1/2">
                                                        @if ($Metana2->isNotEmpty())
                                                            @foreach ($Metana2 as $metana)
                                                                {{ $metana->nilai_metana }}
        @endforeach
        @else
        <p class="text-red-500">No Metana data available.</p>
        @endif
        </p>
        </div>
        </div>
        </div> --}}
        </div>
    </a>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <a href="{{ route('detail.dashboard3', ['id' => 3]) }}" class="col-span-1">
            <div
                class="bg-brown h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
                <div class="w-full mb-6 items-center mt-4">
                    <p class="text-white text-lg font-bold">Lokasi Alat 3</p>
                    <p class="text-white text-sm font-bold">Keterangan Lokasi:</p>
                </div>
                <div class="w-full mb-6">
                    <div class="flex justify-between">
                        <div class="flex w-full">
                            <p class="text-white text-md font-bold w-1/3">Suhu</p>
                            <p class="text-white text-md font-bold w-1/6">:</p>
                            <p class="text-white text-md font-bold w-1/2">
                                @if ($Temperature3->isNotEmpty())
                                @foreach ($Temperature3 as $temperature)
                                {{ $temperature->nilai_suhu }} C
                                @endforeach
                                @else
                            <p class="text-red-500">No Temperature data available.</p>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-6">
                    <div class="flex justify-between">
                        <div class="flex w-full">
                            <p class="text-white text-md font-bold w-1/3">Kelembapan</p>
                            <p class="text-white text-md font-bold w-1/6">:</p>
                            <p class="text-white text-md font-bold w-1/2">
                                @if ($Humidity3->isNotEmpty())
                                @foreach ($Humidity3 as $humidity)
                                {{ $humidity->nilai_humidity }} %
                                @endforeach
                                @else
                            <p class="text-red-500">No Humidity data available.</p>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('detail.dashboard4', ['id' => 4]) }}" class="col-span-1">
            <div class="bg-brown h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
                <div class="w-full mb-6 items-center mt-4">
                    <p class="text-white text-lg font-bold">Lokasi Alat 4</p>
                    <p class="text-white text-sm font-bold">Keterangan Lokasi:</p>
                </div>
                <div class="w-full mb-6">
                    <div class="flex justify-between">
                        <div class="flex w-full">
                            <p class="text-white text-md font-bold w-1/3">Suhu</p>
                            <p class="text-white text-md font-bold w-1/6">:</p>
                            <p class="text-white text-md font-bold w-1/2">
                                @if ($Temperature4->isNotEmpty())
                                @foreach ($Temperature4 as $temperature)
                                {{ $temperature->nilai_suhu }} C
                                @endforeach
                                @else
                            <p class="text-red-500">No Temperature data available.</p>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-6">
                    <div class="flex justify-between">
                        <div class="flex w-full">
                            <p class="text-white text-md font-bold w-1/3">Kelembapan</p>
                            <p class="text-white text-md font-bold w-1/6">:</p>
                            <p class="text-white text-md font-bold w-1/2">
                                @if ($Humidity4->isNotEmpty())
                                @foreach ($Humidity4 as $humidity)
                                {{ $humidity->nilai_humidity }} %
                                @endforeach
                                @else
                            <p class="text-red-500">No Humidity data available.</p>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    </div>
    </div>
    </div>
    </main>

    <!-- Footer -->
    @livewire('partials.footer')

    <!-- Logout form (hidden by default) -->
    <form id="logout-form" action="#" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="logout" value="true">
    </form>
    </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>