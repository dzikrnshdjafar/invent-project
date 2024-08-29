@extends('pages.outer.index')

@section('content')

<div class="text-black flex font-[Poppins] bg-no-repeat bg-cover bg-[url('{{ asset('landpage') }}/asset/objects.svg')]">
    <div class="container mx-auto -mt-30 md:mt-14 md:px-20">
        <h1 class="text-5xl md:text-6xl font-semibold ml-10 mt-10">Daftar Alat</h1>
        <div class="border-8 border-[#259E30] w-[22.2rem] -mt-5"></div>

        {{-- <!-- Search Form -->
        <form action="{{ route('daftar-barang') }}" method="GET" class="mt-10">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="border border-gray-300 px-4 py-2 rounded-md w-full md:w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500">
            <button type="submit" class="mt-4 md:mt-0 ml-2 px-6 py-2 bg-green-600 text-white rounded-md">Cari</button>
        </form> --}}

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mt-20 px-20">
            @if ($items->isEmpty())
                <!-- Tampilkan pesan jika tidak ada hasil pencarian -->
                <div class="col-span-4 text-center">
                    <p class="text-xl font-semibold text-gray-600">Barang yang dicari tidak ada.</p>
                </div>
            @else
                @foreach($items as $item)
                    <div class="">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" width="250">
                        <div class="py-4">
                            <h2 class="text-xl font-bold">{{ $item->name }}</h2>
                            <p class="text-gray-600 mt-2">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="mt-10 mb-20 flex justify-center">
            {{ $items->appends(['search' => request('search')])->links('vendor.pagination.tailwind') }}
        </div>
        
    </div>
</div>

@endsection
