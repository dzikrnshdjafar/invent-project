@section('title', 'Ubah Barang')

<x-app-layout>
    <x-form-card :title="'Ubah Barang'" :backLink="route('items.index')">

        <!-- Flash Messages for Success and Error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Fields for Name, Description, Condition, Category, and Image -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $item->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="condition">Condition</label>
                <select name="condition" class="form-select" id="condition" required>
                    <option value="Baik" {{ $item->condition == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ $item->condition == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Dalam Perbaikan" {{ $item->condition == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-select" id="category" required>
                    <option value="Bisa Dipinjamkan" {{ $item->category == 'Bisa Dipinjamkan' ? 'selected' : '' }}>Bisa Dipinjamkan</option>
                    <option value="Tidak Bisa Dipinjamkan" {{ $item->category == 'Tidak Bisa Dipinjamkan' ? 'selected' : '' }}>Tidak Bisa Dipinjamkan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @if($item->image)
                    <div class="mt-3">
                        <img id="imagePreview" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 200px;" />
                    </div>
                @else
                    <div class="mt-3">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px;" />
                    </div>
                @endif
            </div>

            <!-- Rooms and Quantities Fields -->
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
                                           value="{{ $room->id }}" 
                                           {{ $item->rooms->contains($room->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="roomCheck{{ $room->id }}">{{ $room->name }}</label>
                                </div>
                            </div>
                            <input type="number" name="rooms[{{ $index }}][quantity]" class="form-control quantity-input" 
                                   placeholder="Quantity" id="quantityInput{{ $room->id }}" 
                                   style="display: {{ $item->rooms->contains($room->id) ? 'block' : 'none' }};" 
                                   value="{{ $item->rooms->find($room->id)->pivot->quantity ?? '' }}" 
                                   {{ $item->rooms->contains($room->id) ? '' : 'disabled' }}>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Item</button>
        </form>
    </x-form-card>

    <script>
        // Handle room checkbox toggle for quantity input
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

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "#";
                imagePreview.style.display = 'none';
            }
        });
    </script>
</x-app-layout>
