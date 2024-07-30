<x-app-layout>
    <div class="container">
        <h1>Add Role</h1>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Role</button>
        </form>
    </div>
</x-app-layout>
