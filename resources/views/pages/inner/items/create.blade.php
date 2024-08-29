@section('title', 'Tambah Barang')

<x-app-layout>
    <x-form-card :title="'Form Tambah Barang'" :backLink="route('items.index')">

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

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Fields for Name, Description, Condition, Category, and Image -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="condition">Kondisi</label>
                <select name="condition" class="form-select" id="condition" required>
                    <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ old('condition') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Dalam Perbaikan" {{ old('condition') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="category">Kategori</label>
                <select name="category" class="form-select" id="category" required>
                    <option value="Bisa Dipinjamkan" {{ old('category') == 'Bisa Dipinjamkan' ? 'selected' : '' }}>Bisa Dipinjamkan</option>
                    <option value="Tidak Bisa Dipinjamkan" {{ old('category') == 'Tidak Bisa Dipinjamkan' ? 'selected' : '' }}>Tidak Bisa Dipinjamkan</option>
                </select>
            </div>
            

            <div class="form-group">
                <label for="image">Upload Gambar</label>
                <input type="file" name="image" class="form-control" id="image" required>
                <div class="mt-3">
                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px;" />
                </div>
            </div>

            <!-- Rooms and Quantities Fields -->
            <div class="form-group">
                <label>Kuantitas</label>
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
