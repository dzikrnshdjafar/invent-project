<x-app-layout>
    <div class="container">
        <h1>Add Room</h1>
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Room</button>
        </form>
    </div>
</x-app-layout>
