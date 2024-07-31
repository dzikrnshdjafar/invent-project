<x-app-layout>
    <div class="container">
        <h1>Edit Loan</h1>
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="item_id">Item</label>
                <select name="item_id" class="form-control" id="item_id" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ $loan->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" class="form-control" id="return_date" value="{{ $loan->return_date }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="borrowed" {{ $loan->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ $loan->status == 'returned' ? 'selected' : '' }}>Returned</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Loan</button>
        </form>
    </div>
</x-app-layout>
