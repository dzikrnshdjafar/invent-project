@section('title', 'Barang')

<x-app-layout>
    <section class="row">
        <div class="col-12">
            <div class="row d-flex justify-content-center">
                <x-statistics.info-card 
                    :title="'Barang Tersedia'" 
                    :value="$totalItems" 
                    :iconColor="'green'" 
                    :iconClass="'fas fa-boxes'" 
                />
                <x-statistics.info-card 
                    :title="'Barang Dipinjam'" 
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
                    <a href="{{ route('items.create') }}" class="btn rounded-pill btn-primary mb-0"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
                </x-slot>
                <x-slot name="tableHeader">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Total Quantity</th>
                        <th>Actions</th>
                    </tr>
                </x-slot>
                <x-slot name="tableBody">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                {{ $item->rooms->sum('pivot.quantity') }}
                            </td>
                            <td>
                                <!-- Trigger for Detail Modal -->
                                <button type="button" class="btn rounded-pill btn-light-info" data-bs-toggle="modal" data-bs-target="#itemModal{{ $item->id }}">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn rounded-pill btn-light-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn rounded-pill btn-light-danger"><i class="bi bi-x"></i></button>
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
