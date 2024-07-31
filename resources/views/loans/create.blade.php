<x-app-layout>
    <div class="container">
        <h1>Add Loan</h1>
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="item_id">Item</label>
                <select name="item_id" class="form-control" id="item_id" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Loan</button>
        </form>
    </div>
</x-app-layout>
