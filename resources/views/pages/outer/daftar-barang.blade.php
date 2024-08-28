@extends('pages.outer.index') {{-- Ganti 'app' dengan nama layout Anda jika berbeda --}}

@section('content')


<div class=" text-black flex font-[Poppins] bg-no-repeat bg-cover bg-[url('{{ asset('landpage') }}/asset/objects.svg')]">
    <div class="container mx-auto -mt-30 md:mt-14 px-20">     
        <h1 class="text-5xl md:text-6xl font-semibold ml-10">Daftar Alat</h1>
        <div class="border-8 border-[#259E30] w-[22.2rem] -mt-5"></div>

         <!-- Grid Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mt-20 px-20">
        <!-- Card Item -->
        @foreach($items as $item) <!-- Assume you have a $items collection passed from your controller -->
        <div class="">
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" width="250">
            <div class="py-4">
                <h2 class="text-xl font-bold">{{ $item->name }}</h2>
                <p class="text-gray-600 mt-2">{{ $item->description }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-10 mb-20 flex justify-center">
        {{ $items->links('vendor.pagination.tailwind') }}
    </div>
        
    </div>
</div>
@endsection
