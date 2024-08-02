<!-- resources/views/components/item-modal.blade.php -->
<x-detail-modal 
    :modalId="'itemModal' . $item->id" 
    :modalTitle="$item->name"
>
    <p><strong>Description: </strong>{{ $item->description }}</p>
    <p><strong>Quantity: </strong>{{ $item->quantity }}</p>
    <p><strong>Room: </strong>{{ $item->room->name }}</p>
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
