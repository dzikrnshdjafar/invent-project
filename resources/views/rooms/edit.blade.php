<x-app-layout>
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $room->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Room</button>
        </form>
    </div>
</x-app-layout>
