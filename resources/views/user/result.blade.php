<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="w-full h-auto bg-slate-200">
        <div class="w-full h-[8rem] bg-blue-950 shadow-lg">
            <div
                class="w-[7.5rem] h-[7.5rem] mt-[3rem] rounded-[50%] bg-slate-200 ml-[8rem] shadow-xl flex justify-center items-center absolute">
                <img src="{{ asset('img/buku.jpg') }}" alt="" class="w-[7rem] h-[7rem] rounded-[50%] ">
            </div>
            <div class="w-[50%] h-[8rem] ml-[18rem] flex justify-center flex-col">
                <h1 class="text-white font-bold text-xl">{{ config('app.name', 'laravel') }}</h1>
                <h1 class="text-lg text-white font-medium">NIS : {{ $nis }}</h1>
            </div>
        </div>
        <div class="w-full h-auto flex justify-center items-center px-[3rem]">
            <div class="w-full h-screen bg-white mt-[4rem] mb-[3rem] rounded-[15px] shadow-lg flex">
                <div class="w-[50%] h-full flex justify-center items-center flex-col">
                    <img src="{{ asset('img/' . $siswa->foto) }}" alt=""
                        class="w-[20rem] h-[20rem] rounded-[50%] shadow-lg">
                    <div class="w-full h-[20%] flex justify-center items-center flex-col">
                        <h1 class="text-2xl text-blue-950 font-bold text-center">POINT DOSA</h1>
                        <h1 class="text-red-700 text-4xl font-semibold text-center">{{ $point }}</h1>
                    </div>
                </div>
                <div class="w-[50%] h-full">
                    <h1 class="text-blue-950 text-4xl font-bold ml-4 mt-4">BIODATA</h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Nama : {{ $siswa->nama }}</h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">NISN : {{ $siswa->nisn }}</h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Kelas : {{ $siswa->kelas->nama_kelas }}
                    </h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Jurusan :
                        {{ $siswa->kelas->jurusan->nama_jurusan }}</h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Tempat Lahir : {{ $siswa->tempat_lahir }}
                    </h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Tanggal Lahir :
                        {{ $siswa->tanggal_lahir }}</h1>
                    @if ($siswa->jenis_kelamin == 'L')
                        <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Jenis Kelamin : Laki-Laki</h1>
                    @elseif ($siswa->jenis_kelamin == 'P')
                        <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Jenis Kelamin : Perempuan</h1>
                    @endif
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">Alamat : {{ $siswa->alamat }}</h1>
                    <h1 class="text-blue-950 text-xl font-semibold mt-4 ml-4">No.Telp : {{ $siswa->no_telepon }}</h1>
                </div>
            </div>
        </div>
        <div class="w-full h-auto px-[3rem] border">
            @foreach ($siswa->aksi as $aksi)
                <div class="w-full h-[20rem] bg-white rounded-[15px] shadow-lg mt-[3rem] mb-[3rem]">
                    <div class="w-full h-auto flex items-center">
                        <h1 class="text-4xl text-blue-950 font-bold ml-4 pt-4 ">AKSI DOSA : {{ $aksi->kode_aksi }}</h1>
                        <h1 class="text-xl text-blue-950/60 font-bold ml-4 pt-4">Tanggal : {{ $aksi->tanggal }}</h1>
                        <h1 class="text-xl text-blue-950/60 font-bold ml-4 pt-4">Waktu : {{ $aksi->waktu }}</h1>
                        <h1 class="text-xl text-blue-950/60 font-bold ml-4 pt-4">Guru BK : {{ $aksi->guruBK->nama }}</h1>
                    </div>

                    <div class="w-full h-[15rem] overflow-x-auto overflow-y-auto px-[2rem] mt-[1rem]">
                        <table class="w-full h-full text-sm text-left text-gray-500 ">
                            <thead class="text-md text-white uppercase bg-blue-950">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        KODE
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        NAMA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        KETERANGAN
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        POINT
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aksi->listPelanggaran as $list)
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $list->kode_pelanggaran }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $list->pelanggaran->nama_pelanggaran }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $list->keterangan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $list->pelanggaran->point }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
