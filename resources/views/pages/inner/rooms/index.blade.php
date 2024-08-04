

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
    <div id="roomChart"></div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var rooms = @json($rooms);

        var seriesData = rooms.map(room => ({
            name: room.name,
            data: room.items.map(item => item.quantity)
        }));

        var labels = rooms.length > 0 ? rooms[0].items.map(item => item.name) : [];

        var options = {
            chart: {
                type: 'bar'
            },
            series: seriesData,
            xaxis: {
                categories: labels
            },
            colors: rooms.map((_, index) => {
                // Generate different colors for each room
                var colors = ['#1E90FF', '#FF6347', '#32CD32', '#FFD700', '#8A2BE2', '#FF4500'];
                return colors[index % colors.length];
            })
        };

        var chart = new ApexCharts(document.querySelector("#roomChart"), options);
        chart.render();
    });
</script>
