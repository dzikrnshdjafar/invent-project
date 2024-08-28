@section('title', 'Barang')

<x-app-layout>
    <section class="row">
        <div class="col-12">
            <div class="row d-flex justify-content-center">
                <x-statistics.info-card 
                    :title="'Tersedia'" 
                    :value="$totalItems" 
                    :iconColor="'green'" 
                    :iconClass="'fas fa-boxes'" 
                />
                <x-statistics.info-card 
                    :title="'Dipinjam'" 
                    :value="$borrowedItems" 
                    :iconColor="'red'" 
                    :iconClass="'fas fa-handshake'" 
                />
            </div>
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-light-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-light-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <x-table-card :title="'Daftar Barang'">
                <x-slot name="headerActions">
                    <a href="{{ route('items.create') }}" class="btn btn-primary mb-0"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
                </x-slot>
                <x-slot name="tableHeader">
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Kategori</th> <!-- New column for category -->
                        <th>Kondisi</th> <!-- New column for condition -->
                        <th>Gambar</th> <!-- New column for image -->
                        <th>Jumlah</th>
                        <th>Actions</th>
                    </tr>
                </x-slot>
                <x-slot name="tableBody">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->formatted_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category }}</td> <!-- Display category -->
                            <td>{{ $item->condition }}</td> <!-- Display condition -->
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $item->rooms->sum('pivot.quantity') }}</td>
                            <td>
                                <!-- Trigger for Detail Modal -->
                                <button type="button" class="btn btn-light-info" data-bs-toggle="modal" data-bs-target="#itemModal{{ $item->id }}">
                                    Detail
                                </button>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-light-warning">Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @include('pages.inner.items.show', ['item' => $item])
                    @endforeach
                </x-slot>
            </x-table-card>
        </div>
    </section>
</x-app-layout>
