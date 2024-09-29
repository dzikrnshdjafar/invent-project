@extends('pages.outer.index')

@section('content')

<div class="text-black flex font-[Poppins] bg-no-repeat bg-cover bg-[url('{{ asset('landpage') }}/asset/objects.svg')] relative">
    <!-- Background pertama -->
    
    
    <div class="container mx-auto -mt-30 md:mt-14 md:px-20">

        <!-- Bagian Kiri untuk Konten -->
        <div class="w-full md:w-2/3">
            <!-- Flexbox untuk H1 -->
            <div class="flex flex-col items-start ml-10 mt-10 space-y-4 md:space-y-0">
                <h1 class="text-5xl md:text-6xl font-semibold">Profile</h1>
            </div>
            <div class="border-8 border-[#259E30] w-[11.4rem] -mt-5"></div>
            
            <!-- Flexbox untuk Text -->
            <div class="mt-10 px-10 md:px-40">
                <!-- Bagian Deskripsi -->
                <div class="w-full ml-1 md:-ml-[7rem]">
                    <p class="font-bold">Badan Standarisasi Instrumen Pertanian (BSIP) Gorontalo</p>
                     <p>merupakan unit pelaksana teknis di bawah Kementerian Pertanian Republik Indonesia yang memiliki tugas untuk menyusun, mengembangkan, dan menerapkan standar serta instrumen di sektor pertanian. <strong>BSIP Gorontalo</strong> berperan penting dalam mendukung peningkatan produktivitas pertanian melalui pengembangan teknologi, penyediaan alat dan mesin pertanian yang terstandarisasi, serta program-program pelatihan yang berorientasi pada kemajuan petani lokal. Dengan dedikasi yang kuat, kami berkomitmen untuk memajukan pertanian berkelanjutan dan mendukung ketahanan pangan nasional.</p>
                     <p class="text-lg font-bold mt-6">Kunjungi Website Utama BSIP Gorontalo </p>

                     <button class="rounded-lg py-6 px-[7rem] bg-[#429C4A] mt-4">
                         <a href="https://gorontalo.bsip.pertanian.go.id/ "></a>
                        </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Background kedua -->
<div class="absolute hidden md:block sm:block absolute w-[140vh] h-[150vh] -bottom-[45vh] right-[10vh] bg-no-repeat bg-[url('{{ asset('landpage') }}/asset/kebun.png')] bg-[length:100%]"></div>

<!-- Background pertama -->
<div class="absolute hidden md:block sm:block absolute w-[120vh] h-[100vh] -bottom-[10vh] right-[10vh] bg-no-repeat bg-[url('{{ asset('landpage') }}/asset/orangdudu.png')] bg-[length:100%]"></div>

@endsection
