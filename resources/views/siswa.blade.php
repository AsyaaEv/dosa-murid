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
    <section class="w-screen h-screen relative">
        <img src="{{ asset('img/gunung.jpg') }}" alt="" class="w-screen h-screen object-cover">

        <div
            class="absolute top-0 left-0 w-screen h-screen bg-black bg-opacity-40 flex flex-col justify-center items-center">
            <div
                class="w-[30rem] h-[30rem] bg-blue-950/30 rounded-[15px] backdrop-blur-sm flex flex-col justify-center items-center">
                <img src="{{ asset('img/buku.jpg') }}" alt=""
                    class="w-[5rem] h-[5rem] rounded-[50%] object-cover mb-[1rem]">
                <div class="text-2xl font-bold text-white mb-3">{{ config('app.name', 'Laravel') }}</div>
                <div class="text-xl text-gray-200 mb-4">Masukan nis kamu... dibawah sini...</div>
                <form action="{{ route('result') }}"
                    class="w-[80%] h-auto flex justify-center items-center flex-row gap-[10px]">
                    <input type="number" name="nis" id="nis" placeholder="NIS Anda" required
                        class="w-full h-[3rem] text-[1.2rem] bg-white rounded-[10px] outline-none">
                    <button
                        class="w-[8rem] h-[3rem] bg-blue-700 text-white hover:scale-[1.1] transition-all rounded-[10px] outline-none font-bold ">Submit</button>
                </form>

                <div class="w-full h-auto mt-4 flex justify-center items-center">
                    <h1 class="text-md text-white font-medium">Masuk Sebagai User?</h1>
                    <a href="{{ route('siswa.user')}}" class="text-md text-white font-medium ml-2 py-2 px-2 bg-blue-700 rounded-[10px] hover:scale-[1.1] transition-all">Klik</a>
                </div>

            </div>
        </div>
    </section>

</body>

</html>
