<x-app-layout>
    <div class="container">
        <h1>Create Loan</h1>
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="item_id">Item:</label>
                <select name="item_id" id="item_id" class="form-control" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="loan_duration">Loan Duration (in days):</label>
                <input type="number" name="loan_duration" id="loan_duration" class="form-control" required min="1">
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Create Loan</button>
        </form>
    </div>
</x-app-layout>
