@section('title', 'Pinjam Barang')

<x-app-layout>
    <x-form-card :title="'Form Pinjam Barang'" :backLink="route('loans.index')">
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="item_id">Item:</label>
                <select name="item_id" id="item_id" class="form-control" required onchange="updateAvailableQuantity()">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" data-available-quantity="{{ $item->available_quantity }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="loan_duration">Loan Duration (in days):</label>
                <input type="number" name="loan_duration" id="loan_duration" class="form-control" required min="1">
            </div>
            <div class="form-group mt-3">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                <small id="available-quantity" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Loan</button>
        </form>
    </x-form-card>

    <script>
        function updateAvailableQuantity() {
            var select = document.getElementById('item_id');
            var quantityInput = document.getElementById('quantity');
            var availableQuantityText = document.getElementById('available-quantity');
            
            var selectedOption = select.options[select.selectedIndex];
            var availableQuantity = selectedOption.getAttribute('data-available-quantity');
            
            availableQuantityText.textContent = 'Available Quantity: ' + availableQuantity;
            quantityInput.setAttribute('max', availableQuantity);
        }

        // Initialize available quantity display on page load
        updateAvailableQuantity();
    </script>
</x-app-layout>
