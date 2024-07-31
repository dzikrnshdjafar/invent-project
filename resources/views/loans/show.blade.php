<x-app-layout>
    <div class="container">
        <h1>Loan Details</h1>
        <p><strong>ID:</strong> {{ $loan->id }}</p>
        <p><strong>Item:</strong> {{ $loan->item->name }}</p>
        <p><strong>User:</strong> {{ $loan->user->name }}</p>
        {{-- <p><strong>Loan Date:</strong> {{ $loan->loan_date }}</p> --}}
        <p><strong>Return Date:</strong> {{ $loan->return_date ?? 'Not returned yet' }}</p>
        <p><strong>Status:</strong> {{ $loan->status }}</p>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</x-app-layout>
