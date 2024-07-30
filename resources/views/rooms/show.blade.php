<x-app-layout>
    <div class="container">
        <h1>Room Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $room->name }}</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
