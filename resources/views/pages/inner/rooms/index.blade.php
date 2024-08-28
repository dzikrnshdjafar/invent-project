@section('title', 'Ruangan')

<x-app-layout>
    <x-table-card :title="'Daftar Ruangan'">
        <x-slot name="headerActions">
            <a href="{{ route('rooms.create') }}" class="btn rounded-3xl btn-primary mb-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Ruangan
            </a>
        </x-slot>
        <x-slot name="tableHeader">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td>
                        <!-- Trigger for Detail Modal -->
                        <button type="button" class="btn rounded-3xl btn-light-info me-2 mb-2" data-bs-toggle="modal" data-bs-target="#roomModal{{ $room->id }}">
                            <i class="bi bi-info-circle me-1"></i> Detail
                        </button>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn rounded-3xl btn-light-warning me-2 mb-2">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-3xl btn-light-danger mb-2" onclick="return confirm('Are you sure you want to delete this room?')">
                                <i class="bi bi-trash3 me-1"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @include('pages.inner.rooms.show', ['room' => $room])
            @endforeach
        </x-slot>
    </x-table-card>
</x-app-layout>
