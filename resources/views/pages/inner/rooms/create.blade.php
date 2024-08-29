@section('title', 'Tambah Ruangan')

<x-app-layout>
    <x-form-card :title="'Form Tambah Ruangan'" :backLink="route('rooms.index')">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Buat Ruangan</button>
        </form>
    </x-form-card>
</x-app-layout>
