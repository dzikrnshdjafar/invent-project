@section('title', 'Ubah Peminjaman')

<x-app-layout>
    <x-form-card :title="'Ubah Peminjaman'" :backLink="route('loans.index')">
        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="item_id">Item</label>
                <select name="item_id" class="form-control" id="item_id" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ $loan->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="return_date">Tanggal Pengembalian</label>
                <input type="date" name="return_date" class="form-control" id="return_date" value="{{ $loan->return_date }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="pending" {{ $loan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="borrowed" {{ $loan->status == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="returned" {{ $loan->status == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Peminjaman</button>
        </form>
    </x-form-card>
</x-app-layout>
