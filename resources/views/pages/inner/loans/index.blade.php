@section('title', 'Peminjaman')
<x-app-layout>
    <!-- Alert section -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-table-card :title="'Daftar Peminjaman'">
        @can('Create Loans')
        <x-slot name="headerActions">
            <a href="{{ route('loans.create') }}" class="btn rounded-pill btn-primary mb-0"><i class="bi bi-plus-lg"></i> Buat Peminjaman</a>
        </x-slot>
        @endcan
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
                <th>Quantities</th>
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
                    <td>{{ $loan->quantity }}</td>
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
                        @can('Edit Loans')
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn rounded-pill btn-light-warning"><i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('Delete Loans')
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn rounded-pill btn-light-danger" onclick="return confirm('Are you sure you want to delete this loan?')"><i class="bi bi-x"></i></button>
                        </form>
                        @endcan
                        @can('Manage Quantities')
                            @if($loan->status == 'pending')
                                <a href="{{ route('loans.manageQuantities', $loan->id) }}" class="btn rounded-pill btn-primary">Manage Quantities</a>
                            @endif
                        @endcan
                        @can('Return Items')
                            @if($loan->status == 'borrowed')
                                <a href="{{ route('loans.returnItemsForm', $loan->id) }}" class="btn rounded-pill btn-success">Return Items</a>
                            @endif
                        @endcan
                    </td>
                </tr>
                @include('pages.inner.loans.show', ['loan' => $loan])
            @endforeach
        </x-slot>
    </x-table-card>
</x-app-layout>
