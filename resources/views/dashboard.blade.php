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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
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
            background-color: #4C4B16;
            /* Kode HEX warna coklat */
        }

        /* From Uiverse.io by andrew-demchenk0 */
        .switch {
            --input-focus: #4e93f6;
            /* Warna biru yang lebih cerah saat aktif */
            --bg-color: #333333;
            /* Warna latar belakang gelap */
            --bg-color-alt: #ccc;
            /* Warna latar belakang tidak aktif */
            --main-color: #fff;
            /* Warna putih untuk elemen utama */
            --input-out-of-focus: #ddd;
            /* Warna latar belakang saat tidak aktif */
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90px;
            /* Lebar toggle lebih besar */
            height: 50px;
            /* Tinggi lebih besar untuk bentuk lebih proporsional */
            border-radius: 50px;
            /* Membuat toggle berbentuk bulat */
            background-color: var(--bg-color-alt);
            transition: background-color 0.3s, box-shadow 0.3s ease-in-out;
            /* Transisi halus */
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            /* Bayangan lebih lembut */
        }

        .toggle {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50px;
            background-color: var(--input-out-of-focus);
            border: none;
            transition: 0.4s ease-in-out;
            /* Transisi lebih halus */
        }

        .slider:before {
            content: "OFF";
            position: absolute;
            top: 50%;
            left: 5px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-color);
            color: var(--main-color);
            font-size: 16px;
            font-weight: 700;
            text-align: center;
            line-height: 40px;
            transform: translateY(-50%);
            transition: 0.4s ease-in-out;
            /* Efek animasi pada label */
        }

        /* Ketika toggle aktif */
        .toggle:checked+.slider {
            background-color: var(--input-focus);
            box-shadow: 0 4px 18px rgba(0, 143, 255, 0.5);
            /* Bayangan lebih kuat */
        }

        .toggle:checked+.slider:before {
            content: "ON";
            transform: translateY(-50%) translateX(40px);
            /* Geser tombol ke kanan */
            color: #fff;
            /* Ubah warna teks saat aktif */
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
                        <div class="flex">
                            <div class="px-8 py-8 w-4/5">
                                <!-- div card alat -->
                                <div class="grid grid-cols-2 gap-4">
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($alatData as $item)
                                    <a href="{{ route('detail.dashboard', ['id' => $item['id_alat']]) }}" class="col-span-1">
                                        <div class="bg-brown h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
                                            <div class="w-full mb-6 items-center mt-4">
                                                <p class="text-white text-lg font-bold">Lokasi Alat : {{ $item['id_alat'] }}</p>
                                                <p class="text-white text-sm font-bold">Keterangan Lokasi:</p>
                                            </div>
                                            <div class="w-full mb-6">
                                                <div class="flex justify-between">
                                                    <div class="flex w-full">
                                                        <p class="text-white text-md font-bold w-1/3">Suhu</p>
                                                        <p class="text-white text-md font-bold w-1/6">:</p>
                                                        <p class="text-white text-md font-bold w-1/2">
                                                            {{ $item['Temperature']->nilai_temperature ?? 'Data not available' }}°C
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
                                                            {{ $item['Humidity']->nilai_humidity ?? 'Data not available' }}%
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mb-6">
                                                <div class="flex justify-between">
                                                    <div class="flex w-full">
                                                        <p class="text-white text-md font-bold w-1/3">Terakhir Update</p>
                                                        <p class="text-white text-md font-bold w-1/6">:</p>
                                                        <p class="text-white text-md font-bold w-1/2">
                                                            {{ $item['Temperature']->updated_at ?? 'Data not available' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- card kontrol -->
                            <div class="flex flex-col gap-4 w-1/4 pr-8 pt-8">
                                <div class="bg-black rounded-lg p-6 shadow-md relative h-56 flex flex-col justify-center items-center">
                                    <div class="absolute top-4 left-4 flex items-center">
                                        <img src="{{ asset('assets/img/hum-icon.png')}}" alt="Icon" class="w-12 h-12 rounded-full">
                                        <p class="text-white font-semibold ml-4">Kontrol Manual</p>
                                    </div>
                                    <div class="flex items-center">
                                        <label class="switch">
                                            <input {{ $status == '1' ? 'checked' : '' }} type="checkbox" class="toggle" onclick="toggleSwitch({{ $status }}, this)" id="toggle">
                                            <span class="slider"></span>
                                            <span class="card-side"></span>
                                        </label>
                                    </div>
                                    <p class="absolute bottom-10 left-4 text-white font-semibold">Penyemprotan Manual</p>
                                    <p class="absolute bottom-4 left-4 text-white text-sm">Aktifkan ketika kontrol otomatis bermasalah</p>
                                </div>
                                <div class="bg-black rounded-lg p-6 h-auto shadow-md relative flex flex-col justify-center items-center overflow-y-auto">
                                    <div class="top-4 left-4 flex items-center">
                                        <img src="{{ asset('assets/img/hum-icon.png') }}" alt="Icon" class="w-12 h-12 rounded-full">
                                        <p class="text-white font-semibold ml-4">Kontrol Otomatis</p>
                                    </div>

                                    <div class="text-center mt-8 flex space-x-8">
                                        <div>
                                            <p class="text-white text-sm font-medium">Rata-rata Suhu</p>
                                            <p class="text-white text-lg font-bold">24°C</p>
                                        </div>

                                        <div>
                                            <p class="text-white text-sm font-medium">Rata-rata Kelembapan</p>
                                            <p class="text-white text-lg font-bold">60%</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-start w-full mt-4 space-y-2">
                                        <div class="flex items-center w-full">
                                            <p class="text-white text-sm font-semibold">Pompa ON Suhu Diatas</p>
                                            <div class="flex items-center ml-auto">
                                                <input type="number" id="suhuOnAbove" class="text-center w-14 text-sm font-bold bg-transparent text-white border-none mx-1" value="26" />
                                                <div class="flex flex-col space-y-0.5">
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="increaseValue('suhuOnAbove')">▲</button>
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="decreaseValue('suhuOnAbove')">▼</button>
                                                </div>
                                                <span class="text-sm font-bold text-white ml-2">°C</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <p class="text-white text-sm font-semibold">Pompa OFF Suhu Bawah</p>
                                            <div class="flex items-center ml-auto">
                                                <input type="number" id="suhuOffBelow" class="text-center w-14 text-sm font-bold bg-transparent text-white border-none mx-1" value="26" />
                                                <div class="flex flex-col space-y-0.5">
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="increaseValue('suhuOffBelow')">▲</button>
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="decreaseValue('suhuOffBelow')">▼</button>
                                                </div>
                                                <span class="text-sm font-bold text-white ml-2">°C</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <p class="text-white text-sm font-semibold">Pompa ON Kelembapan Dibawah</p>
                                            <div class="flex items-center ml-auto">
                                                <input type="number" id="kelembapanOnBelow" class="text-center w-14 text-sm font-bold bg-transparent text-white border-none mx-1" value="80" />
                                                <div class="flex flex-col space-y-0.5">
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="increaseValue('kelembapanOnBelow')">▲</button>
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="decreaseValue('kelembapanOnBelow')">▼</button>
                                                </div>
                                                <span class="text-sm font-bold text-white ml-2">%</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <p class="text-white text-sm font-semibold">Pompa OFF Kelembapan Diatas</p>
                                            <div class="flex items-center ml-auto">
                                                <input type="number" id="kelembapanOffAbove" class="text-center w-14 text-sm font-bold bg-transparent text-white border-none mx-1" value="80" />
                                                <div class="flex flex-col space-y-0.5">
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="increaseValue('kelembapanOffAbove')">▲</button>
                                                    <button class="bg-gray-700 text-white px-1 py-0.5 text-xs" onclick="decreaseValue('kelembapanOffAbove')">▼</button>
                                                </div>
                                                <span class="text-sm font-bold text-white ml-2">%</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-center w-full mt-8">
                                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md w-3/4" onclick="#">Set</button>
                                        </div>
                                    </div>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSwitch(status, element) {

            const status_awal = status;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/control_state";
                } else {
                    element.checked = status == '1';
                }
            });


        }


        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('
            success ') }}',
        });
        @endif
    </script>

    <script>
        function increaseValue(id) {
            const input = document.getElementById(id);
            input.value = parseInt(input.value) + 1;
        }

        function decreaseValue(id) {
            const input = document.getElementById(id);
            input.value = parseInt(input.value) - 1;
        }
    </script>
    @vite('resources/js/app.js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
</body>

</html>