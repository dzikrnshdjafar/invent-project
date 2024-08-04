<!-- resources/views/pages/inner/loans/manage-quantities.blade.php -->
@section('title', 'Manage Quantities')

<x-app-layout>
    <x-form-card :title="'Manage Quantities for Loan #'.$loan->id" :backLink="route('loans.index')">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('loans.updateQuantities', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Rooms and Quantities</label>
                <div id="rooms-wrapper">
                    @foreach ($rooms as $index => $room)
                        @php
                            $availableQuantity = $room->items->first() ? $room->items->first()->pivot->quantity : 0;
                        @endphp
                        <div class="room-quantity-group mb-2">
                            <label>{{ $room->name }} (Available: {{ $availableQuantity }})</label>
                            <input type="number" name="quantities[{{ $index }}][quantity]" class="form-control" placeholder="Quantity" required max="{{ $availableQuantity }}">
                            <input type="hidden" name="quantities[{{ $index }}][room_id]" value="{{ $room->id }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Quantities</button>
        </form>
    </x-form-card>
</x-app-layout>
