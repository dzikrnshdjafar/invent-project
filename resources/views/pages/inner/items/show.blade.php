@props(['item'])

<x-detail-modal :modalId="'itemModal'.$item->id" :modalTitle="$item->name">
    <x-slot name="slot">
        <p><strong>Description: </strong>{{ $item->description }}</p>
        <p><strong>Rooms and Quantities: </strong></p>
        <ul>
            @foreach ($item->rooms as $room)
                <li>{{ $room->name }}: {{ $room->pivot->quantity }}</li>
            @endforeach
        </ul>
    </x-slot>
    <x-slot name="footer">
        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </x-slot>
</x-detail-modal>
