@section('title', 'Ubah Ruang')

<x-app-layout>
    <x-form-card :title="'Ubah Ruang'" :backLink="route('rooms.index')">
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $room->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Ruang</button>
        </form>
    </x-form-card>
</x-app-layout>
