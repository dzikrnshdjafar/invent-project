<!-- resources/views/pages/inner/loans/index.blade.php -->
@section('title', 'Peminjaman')
<x-app-layout>
    <x-table-card :title="'Daftar Peminjaman'">
        <x-slot name="headerActions">
            <a href="{{ route('loans.create') }}" class="btn rounded-pill btn-primary mb-0"><i class="bi bi-plus-lg"></i> Buat Peminjaman</a>
        </x-slot>
        <x-slot name="tableHeader">
            <tr>
                <th>ID</th>
                <th>Item</th>
                @if (Auth::user()->hasRole('Admin'))
                    <th>User</th> <!-- Only display this column if the user is Admin -->
                @endif
                <th>Loan Date</th>
                <th>Return Date</th>
                <th>Duration (days)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </x-slot>
        <x-slot name="tableBody">
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->item->name }}</td>
                    @if (Auth::user()->hasRole('Admin'))
                        <td>{{ $loan->user->name }}</td> <!-- Only display this cell if the user is Admin -->
                    @endif
                    <td>{{ $loan->created_at }}</td>
                    <td>{{ $loan->return_date ?? 'Not returned yet' }}</td>
                    <td>{{ $loan->loan_duration }}</td>
                    <td>
                        @if($loan->status == 'borrowed')
                            <span class="badge bg-light-warning">Borrowed</span>
                        @elseif($loan->status == 'returned')
                            <span class="badge bg-light-success">Returned</span>
                        @else
                            <span class="badge bg-light-secondary">{{ ucfirst($loan->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <!-- Trigger for Detail Modal -->
                        <button type="button" class="btn rounded-pill btn-light-info" data-bs-toggle="modal" data-bs-target="#loanModal{{ $loan->id }}">
                            <i class="bi bi-info-circle"></i>
                        </button>
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn rounded-pill btn-light-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill btn-light-danger"><i class="bi bi-x"></i></button>
                        </form>
                        @can('Return Items')
                            @if($loan->status == 'borrowed')
                                <form action="{{ route('loans.returnItem', $loan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn rounded-pill btn-success">Return</button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
                @include('pages.inner.loans.show', ['loan' => $loan])
            @endforeach
        </x-slot>
    </x-table-card>
</x-app-layout>
