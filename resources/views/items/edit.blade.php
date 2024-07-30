<x-app-layout>
    <div class="container">
        <h1>Edit Item</h1>
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $item->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $item->quantity }}" required>
            </div>
            <div class="form-group">
                <label for="room_id">Room</label>
                <select name="room_id" class="form-control" id="room_id" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $item->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Item</button>
        </form>
    </div>
</x-app-layout>
