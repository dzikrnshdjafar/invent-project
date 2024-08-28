

@section('title', 'Ruangan')

<x-app-layout>
    <x-table-card :title="'Daftar Ruangan'">
        <x-slot name="headerActions">
            <a href="{{ route('rooms.create') }}" class="btn rounded-3xl btn-primary mb-0">
                <i class="bi bi-plus-lg"></i> Tambah Ruangan
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
                        <button type="button" class="btn rounded-3xl btn-light-info" data-bs-toggle="modal" data-bs-target="#roomModal{{ $room->id }}">
                            Detail
                        </button>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn rounded-3xl btn-light-warning">Edit</a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-3xl btn-light-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @include('pages.inner.rooms.show', ['room' => $room])
            @endforeach
        </x-slot>
    </x-table-card>
    </x-app-layout>