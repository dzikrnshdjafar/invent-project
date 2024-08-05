<!-- resources/views/pages/inner/loans/show.blade.php -->
@props(['loan'])

<x-detail-modal :modalId="'loanModal'.$loan->id" :modalTitle="'Loan Details'">
    <x-slot name="slot">
        <p><strong>ID:</strong> {{ $loan->id }}</p>
        <p><strong>Item:</strong> {{ $loan->item->name }}</p>
        <p><strong>User:</strong> {{ $loan->user->name }}</p>
        <p><strong>Return Date:</strong> {{ $loan->return_date ?? 'Not returned yet' }}</p>
        <p><strong>Quantities:</strong> {{ $loan->quantity }}</p>
        <p><strong>Status:</strong> {{ $loan->status }}</p>
    </x-slot>
    <x-slot name="footer">
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Close</a>
    </x-slot>
</x-detail-modal>
