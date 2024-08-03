

@section('title', 'Ruangan')

<x-app-layout>
    <x-table-card :title="'Daftar Ruangan'">
        <x-slot name="headerActions">
            <a href="{{ route('rooms.create') }}" class="btn rounded-pill btn-primary mb-0">
                <i class="bi bi-plus-lg"></i> Tambah Ruangan
            </a>
        </x-slot>
        <x-slot name="tableHeader">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td>
                        <!-- Trigger for Detail Modal -->
                        <button type="button" class="btn rounded-pill btn-light-info" data-bs-toggle="modal" data-bs-target="#roomModal{{ $room->id }}">
                            <i class="bi bi-info-circle"></i>
                        </button>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn rounded-pill btn-light-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill btn-light-danger"><i class="bi bi-x"></i></button>
                        </form>
                    </td>
                </tr>
                @include('pages.inner.rooms.show', ['room' => $room])
            @endforeach
        </x-slot>
    </x-table-card>

    <!-- Chart Container -->
    <div>
        <canvas id="roomChart"></canvas>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('roomChart').getContext('2d');
        var rooms = @json($rooms);
        var labels = rooms.map(room => room.name);
        var data = rooms.map(room => room.total_quantity);

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Quantity of Items',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
