@section('title', 'Tambah Barang')

<x-app-layout>
    <x-form-card :title="'Add Item'" :backLink="route('items.index')">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description"></textarea>
            </div>

            <div class="form-group">
                <label>Rooms and Quantities</label>
                <div id="rooms-wrapper">
                    @foreach ($rooms as $index => $room)
                        <div class="room-quantity-group">
                            <div class="form-check">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="form-check-input form-check-primary room-checkbox" 
                                           name="rooms[{{ $index }}][room_id]" 
                                           id="roomCheck{{ $room->id }}" 
                                           value="{{ $room->id }}">
                                    <label class="form-check-label" for="roomCheck{{ $room->id }}">{{ $room->name }}</label>
                                </div>
                            </div>
                            <input type="number" name="rooms[{{ $index }}][quantity]" class="form-control quantity-input" 
                                   placeholder="Quantity" id="quantityInput{{ $room->id }}" style="display:none;" disabled>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Item</button>
        </form>
    </x-form-card>

    <script>
        document.querySelectorAll('.room-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var quantityInput = document.getElementById('quantityInput' + this.value);
                if (this.checked) {
                    quantityInput.style.display = 'block';
                    quantityInput.disabled = false;
                    quantityInput.required = true;
                } else {
                    quantityInput.style.display = 'none';
                    quantityInput.disabled = true;
                    quantityInput.required = false;
                }
            });
        });
    </script>
</x-app-layout>
