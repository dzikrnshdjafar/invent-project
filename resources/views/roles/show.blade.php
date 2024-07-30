<x-app-layout>
    <div class="container">
        <h1>Role Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $role->name }}</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
