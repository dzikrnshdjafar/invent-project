@section('title', 'Tambah Barang')

<x-app-layout>
    <x-form-card :title="'Add Item'" :backLink="route('items.index')">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" required>
            </div>
            <div class="form-group">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" id="room_id" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Item</button>
        </form>
    </x-form-card>
</x-app-layout>
