@section('title', 'Return Items')

<x-app-layout>
    <x-form-card :title="'Return Items for Loan #'.$loan->id" :backLink="route('loans.index')">
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

        <form action="{{ route('loans.returnItems', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="text-center mb-2">
                    <h5>Jumlah Barang Yang Dipinjam</h5>
                    <h1>
                        <span id="loan-quantities-badge" class="badge bg-light-danger">
                            {{ $loanQuantities }}
                        </span>
                    </h1>
                </div>
                <label>Kuantitas dalam Ruangan</label>
                <div id="rooms-wrapper">
                    @foreach ($rooms as $index => $room)
                        <div class="room-quantity-group mb-2">
                            <label>{{ $room->name }}</label>
                            <input type="number" name="quantities[{{ $index }}][quantity]" class="form-control room-quantity-input" placeholder="Quantity" oninput="checkQuantities()">
                            <input type="hidden" name="quantities[{{ $index }}][room_id]" value="{{ $room->id }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Return Items</button>
        </form>
    </x-form-card>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.checkQuantities = function () {
            let loanQuantities = parseInt('{{ $loanQuantities }}');
            let totalInputQuantity = 0;

            document.querySelectorAll('.room-quantity-input').forEach(function (input) {
                totalInputQuantity += parseInt(input.value) || 0;
            });

            let badge = document.getElementById('loan-quantities-badge');
            if (totalInputQuantity === loanQuantities) {
                badge.classList.remove('bg-light-danger');
                badge.classList.add('bg-success');
            } else {
                badge.classList.remove('bg-success');
                badge.classList.add('bg-light-danger');
            }
        };
    });
</script>
