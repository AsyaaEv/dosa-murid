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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="w-screen h-auto bg-slate-200 flex items-center flex-col overflow-x-none">
        <div class="w-full h-[6rem] bg-[#9ec2f0] drop-shadow-xl shadow-lg flex  items-center">
            <img src="{{ asset('img/buku.jpg') }}" alt="" class="w-[3rem] h-[3rem] rounded-[50%] mx-[1rem]">
            <div class="text-lg font-semibold text-white">{{ config('app.name', 'laravel') }}</div>
        </div>
        <div class="w-[95%] h-auto bg-white rounded-[10px] mt-[1rem] mb-[1rem] shadow-lg">
            <div
                class="font-bold text-lg text-center rounded-[10px] py-[2rem] mx-[1rem] mt-[1rem] bg-blue-950 text-white">
                Kode Aksi : {{ $kode_aksi }}</div>
            @if ($aksi == null)
                <div class="font-semibold text-lg py-[3rem] text-center">.:KODE AKSI TIDAK DI TEMUKAN:.</div>
            @else
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Nama : {{ $siswa->nama }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">NISN : {{ $siswa->nisn }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Kelas : {{ $siswa->kelas->nama_kelas }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Jurusan : {{ $siswa->kelas->jurusan->nama_jurusan }}
                </div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Alamat : {{ $siswa->alamat }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Tanggal : {{ $aksi->tanggal }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem]">Waktu : {{ $aksi->waktu }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem] ">Guru BK : {{ $aksi->guruBK->nama }}</div>
                <div class="font-bold text-lg pl-[2rem] mt-[1rem] mb-[1rem]">Point : {{ $point }}</div>

                <form action="{{ route('pelanggaran.add.aksi', $kode_aksi) }}" method="POST">
                    @csrf

                    <label for="countries" class=" my-[0.5rem] text-lg ml-[2rem] font-bold ">Pelanggaran</label>
                    <select id="kode_pelanggaran" name="kode_pelanggaran"
                        class="bg-slate-200 mx-[1rem] text-lg rounded-lg">
                        <option value="" disabled selected>--Pilih Pelanggaran--</option>

                        @foreach ($pelanggaranAll as $pelanggaran)
                            <option class="text-red-500" value="{{ $pelanggaran->kode_pelanggaran }}">{{ $pelanggaran->nama_pelanggaran }}
                        @endforeach
                    </select>

                    <div class="w-full h-auto flex flex-col">
                        <label for="" class="font-bold text-lg ml-[2rem] mt-[0.5rem]">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan"
                            class="outline-none bg-slate-200 mt-[0.5rem] mx-[2rem] rounded-[10px]">
                    </div>
                    <button type="submit"
                        class="w-[13rem] h-[3rem] bg-blue-950 rounded-[15px] ml-[2rem] mb-4 my-[1rem] text-white font-bold">Tambah
                        Pelanggaran</button>

                    </form>
                    <form action="{{route('pelanggaran.print')}}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_aksi" value="{{$kode_aksi}}">
                        <button type="submit"
                            class="w-[5rem] h-[3rem] bg-blue-950 rounded-[15px]  text-white font-bold ml-8 mb-4">Cetak</button>
                    </form>
                <div class="relative overflow-x-auto shadow-md mx-[2rem] rounded-[15px]">
                    <table class="w-full text-sm text-left text-slate-500 border-2 mb-4">
                        <thead class="text-lg text-gray-700 uppercase bg-[#9ec2f0]">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Kode
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pelanggaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Point
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hapus
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aksi->listPelanggaran as $pelanggaran)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4 text-black font-semibold text-lg">
                                        {{ $pelanggaran->kode_pelanggaran }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-md">
                                        {{ $pelanggaran->pelanggaran->nama_pelanggaran }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-md">
                                        {{ $pelanggaran->keterangan }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-md">
                                        {{ $pelanggaran->pelanggaran->point }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-md">
                                        <form action="{{ route('pelanggaran.remove.aksi', $kode_aksi) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id_list" value="{{ $pelanggaran->id }}">
                                            <button type="submit"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
