@extends('pages.outer.index') {{-- Ganti 'app' dengan nama layout Anda jika berbeda --}}

@section('content')
<div class="hero min-h-screen bg-no-repeat bg-[left_bottom_3rem] bg-cover bg-[url('{{ asset('landpage') }}/asset/bg.png')]">
    <div class="hero-content text-center text-white -mt-40 flex flex-col items-center justify-center">
        <div class="max-w-7xl">
            <h1 class="text-4xl md:text-[80px] font-semibold font-[Poppins] leading-tight">
                Optimalkan Pertanian Anda dengan Alat yang Tepat.
            </h1>
            <div class="bg-white rounded-3xl flex items-center shadow-lg mt-10 max-w-3xl mx-auto">
                <input type="text" class="bg-transparent p-3 text-gray-800 focus:outline-none flex-grow">
                <button class="p-2 text-white rounded-3xl hover:bg-green-600 mr-1" style="background-color:#146B1C;">
                    <i class="fa-solid fa-magnifying-glass p-1"></i>Search
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto grid grid-cols-3 md:grid-cols-3 gap-5 md:gap-9 -mt-60 px-20">
    <div class="card bg-[#1A4D2E] h-28 md:h-96 shadow-xl relative">
        <div class="card-body p-3 md:p-8 flex flex-col">
            <img src="{{ asset('landpage') }}/asset/ri_plant-fill.svg" alt="Jumlah Alat" class="w-6 h-6 md:h-16 md:w-16 md:mb-8">
            <h2 class="card-title text-sm md:text-6xl text-center">Jumlah Alat</h2>
            <div class="absolute bottom-4 right-4">
                <h1 class="text-xl md:text-8xl font-extrabold">{{ $itemsBaik }}</h1>
            </div>
        </div>
    </div>
    <div class="card bg-[#1A4D2E] h-28 md:h-96 shadow-xl relative">
        <div class="card-body p-3 md:p-8 flex flex-col">
            <img src="{{ asset('landpage') }}/asset/eva_people-fill.svg" alt="Jumlah Alat" class="w-6 h-6 md:h-16 md:w-16 md:mb-8">
            <h2 class="card-title text-sm md:text-6xl text-center">Jumlah Alat</h2>
            <div class="absolute bottom-4 right-4">
                <h1 class="text-xl md:text-8xl font-extrabold">{{ $itemsDalamPerbaikan }}</h1>
            </div>
        </div>
    </div>
    <div class="card bg-[#1A4D2E] h-28 md:h-96 shadow-xl relative">
        <div class="card-body p-3 md:p-8 flex flex-col">
            <img src="{{ asset('landpage') }}/asset/eva_people-fill.svg" alt="Jumlah Alat" class="w-6 h-6 md:h-16 md:w-16 md:mb-8">
            <div class="badge badge-error md:top-10 left-7 md:left-[75px] absolute badge-sm border-white">!</div>
            <h2 class="card-title text-sm md:text-6xl text-center">Jumlah Alat</h2>
            <div class="absolute bottom-4 right-4">
                <h1 class="text-xl md:text-8xl font-extrabold">{{ $itemsRusak }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="md:h-screen text-black flex font-[Poppins] mt-40 md:-mt-40 bg-no-repeat bg-cover bg-[url('{{ asset('landpage') }}/asset/objects.svg')]">
    <div class="container mx-auto -mt-30 md:mt-96 px-20">     
        <h1 class="text-5xl md:text-6xl font-semibold">Tentang Kami</h1>
        <div class="border-8 border-[#259E30] w-[22.2rem] -mt-5"></div>
        <p class="text-sm mt-10 md:text-3xl ">
            BSIP Gorontalo berkomitmen untuk menyediakan layanan manajemen yang efektif dengan memastikan semua alat pertanian terkelola dengan baik dan siap digunakan kapan saja. Kami percaya bahwa dengan sistem yang tepat, operasional pertanian dapat berjalan lebih lancar dan efisien. 
            <br>
            <br>
            Terima kasih telah menggunakan platform kami untuk mengelola inventaris dan peminjaman alat pertanian. Bersama-sama, kita bisa mencapai pertanian yang lebih produktif dan berkelanjutan di Gorontalo.
        </p>
    </div>
</div>
@endsection
