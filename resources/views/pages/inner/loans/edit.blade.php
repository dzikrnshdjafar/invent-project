@section('title', 'Ubah Peminjaman')

<x-app-layout>
    <x-form-card :title="'Ubah Peminjaman'" :backLink="route('loans.index')">
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="item_id">Barang</label>
                <select name="item_id" class="form-control" id="item_id" required onchange="updateAvailableQuantity()">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" 
                            data-available-quantity="{{ $item->rooms->sum('pivot.quantity') }}" 
                            {{ $loan->item_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="nama_peminjam">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" id="nama_peminjam" value="{{ $loan->nama_peminjam }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $loan->alamat }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="nip_nik">NIP/NIK</label>
                <input type="text" name="nip_nik" class="form-control" id="nip_nik" value="{{ $loan->nip_nik }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $loan->no_hp }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="keterangan" rows="3">{{ $loan->keterangan }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="loan_duration">Durasi Peminjaman (dalam hari)</label>
                <input type="number" name="loan_duration" class="form-control" id="loan_duration" value="{{ $loan->loan_duration }}" required min="1">
            </div>

            <div class="form-group mt-3">
                <label for="quantity">Jumlah Barang Yang Dipinjam</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $loan->quantity }}" required min="1">
                <small id="available-quantity" class="form-text text-muted"></small>
            </div>

            <div class="form-group mt-3">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="pending" {{ $loan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dipinjam" {{ $loan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ $loan->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Peminjaman</button>
        </form>
    </x-form-card>

    <script>
        function updateAvailableQuantity() {
            var select = document.getElementById('item_id');
            var quantityInput = document.getElementById('quantity');
            var availableQuantityText = document.getElementById('available-quantity');
            
            var selectedOption = select.options[select.selectedIndex];
            var availableQuantity = selectedOption.getAttribute('data-available-quantity');
            
            availableQuantityText.textContent = 'Tersedia: ' + availableQuantity;
            quantityInput.setAttribute('max', availableQuantity);
        }

        // Initialize available quantity display on page load
        updateAvailableQuantity();
    </script>
</x-app-layout>
