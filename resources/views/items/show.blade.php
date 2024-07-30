<x-app-layout>
    <div class="container">
        <h1>Item Details</h1>
        <div class="card">
            <div class="card-header">
                <h2>{{ $item->name }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Description: </strong>{{ $item->description }}</p>
                <p><strong>Quantity: </strong>{{ $item->quantity }}</p>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
