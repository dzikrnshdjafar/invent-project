<!-- resources/views/pages/inner/rooms/show.blade.php -->
@props(['room'])

<x-detail-modal :modalId="'roomModal'.$room->id" :modalTitle="$room->name">
    <x-slot name="slot">
        <p><strong>Nama:</strong> {{ $room->name }}</p>
    </x-slot>
    <x-slot name="footer">
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Close</a>
        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </x-slot>
</x-detail-modal>
