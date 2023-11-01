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
    <div class="w-screen h-auto bg-slate-200 flex items-center flex-col">
        <div class="w-full h-[6rem] bg-blue-500 drop-shadow-xl shadow-lg flex  items-center">
            <img src="{{ asset('img/buku.jpg') }}" alt="" class="w-[3rem] h-[3rem] rounded-[50%] mx-[1rem]">
            <div class="text-lg font-semibold text-white">{{ config('app.name', 'laravel') }}</div>
        </div>
        <div class="w-[95%] h-auto bg-white rounded-[10px] mt-[1rem] mb-[1rem] shadow-lg ">
            <div class="text-white py-[2rem] bg-blue-950 text-center rounded-[10px] mx-[1rem] mt-[1rem] font-bold">NIS : {{$nis}}</div>
            @if ($siswa == null)
                <div class="font-semibold text-lg py-[3rem] text-center">.:SISWA TIDAK DI TEMUKAN:.</div>
            @else
                <div class="font-bold text-lg pl-[1rem] mt-[1rem]">Nama : {{ $siswa->nama }}</div>
                <div class="font-bold text-lg pl-[1rem] mt-[1rem]">NISN : {{ $siswa->nisn }}</div>
                <div class="font-bold text-lg pl-[1rem] mt-[1rem]">Kelas : {{ $siswa->kelas->nama_kelas }}</div>
                <div class="font-bold text-lg pl-[1rem] mt-[1rem]">Jurusan : {{ $siswa->kelas->jurusan->nama_jurusan }}
                </div>
                <div class="font-bold text-lg pl-[1rem] mt-[1rem]">Alamat : {{ $siswa->alamat }}</div>
                <form action="{{ route('pelanggaran.store.aksi') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                    <div class="w-full h-auto flex flex-col">
                        <label for="" class="font-bold text-lg pl-[1rem] mt-[0.5rem]">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="outline-none bg-slate-200 mt-[0.5rem] mx-[1rem] rounded-[10px]">
                    </div>
                    <div class="w-full h-auto flex flex-col">
                        <label for="" class="font-bold text-lg pl-[1rem] mt-[0.5rem]">Waktu</label>
                        <input type="time" id="waktu" name="waktu"
                            class="outline-none bg-slate-200 mt-[0.5rem] mx-[1rem] rounded-[10px]">
                    </div>

                    <label for="countries" class=" my-[0.5rem] text-lg ml-[1rem] font-bold ">Pilih Guru BK</label>
                    <select id="kode_bk" name="kode_bk"
                        class="bg-slate-200 mx-[1rem] text-lg rounded-lg">
                        <option value="" disabled selected>---</option>

                        @foreach ($guruBK as $bk)
                            <option value="{{$bk->kode_bk}}">{{$bk->nama}}
                        @endforeach
                    </select>

                    <button
                        class="w-[10rem] h-[3rem] bg-blue-700 rounded-[15px] ml-[1rem] my-[1rem] text-white font-bold">Catat
                        Pelanggaran</button>
            @endif
            </form>
        </div>
    </div>
</body>

</html>
