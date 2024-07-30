<x-app-layout>
    <div class="container">
        <h1>Edit Role</h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </form>
    </div>
</x-app-layout>
