@extends('pages.outer.index')

@section('content')
    <!-- CONTENT -->
    <div class="relative mt-20 ">
        <!-- Text -->
        <div class="relative z-10 flex items-center md:items-center flex-col font-[Poppins] left-0 px-4 md:px-96 md:-ml-96 -mb-10 md:-mb-60">
            <h1 class="text-6xl md:text-[8em] font-bold text-gray-900 mt-12 ">404</h1>
            <p class="text-lg md:text-xl text-gray-600 mt-4">HALAMAN TIDAK DITEMUKAN</p>
            <a href="/" class="mt-6 bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-500 font-[Montserrat] text-center">
                Kembali ke halaman utama
            </a>
        </div>

        <!-- Mountain Image -->
        <img src="{{ asset('landpage') }}/asset/gunung.svg" alt="Mountain" class="mx-auto w-full md:w-[400vh] md:-mb-20 mb-10 z-0 ">

        <!-- Leaves Image -->
        <img src="{{ asset('landpage') }}/asset/daun.svg" alt="Leaves" class="absolute bottom-0 left-0 h-[20vh] md:h-[46vh] z-0 -mb-12">

        <!-- Building Image -->
        <img src="{{ asset('landpage') }}/asset/centerpointdaun.svg" alt="Building" class="absolute bottom-0 right-0 h-[40vh] md:h-[90vh] z-0 -mb-20">
    </div>
@endsection
