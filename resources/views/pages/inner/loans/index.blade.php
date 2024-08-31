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
   <!-- Collapse Button -->
   <div class="mb-3 tw-flex tw-justify-end">
    <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
        <i class="bi bi-filter"></i> Filter Tanggal
    </button>
</div>


     <!-- Filter Form -->
     <div class="card collapse {{ request('start_date') || request('end_date') ? 'show' : '' }}" id="filterForm">
        <form action="{{ route('loans.index') }}" method="GET" class="tw-flex tw-flex-col md:tw-flex-row tw-p-6 gap-4 tw-justify-center">
            <div class="tw-flex tw-flex-row gap-4 tw-w-full">
                <div class="tw-flex-1 w-1/3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control w-full" value="{{ request('start_date') }}">
                </div>
                <div class="tw-flex-1 w-1/3">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" class="form-control w-full" value="{{ request('end_date') }}">
                </div>
            </div>
                <div class="tw-flex gap-4 tw-items-end">
                    <button type="submit" class="btn btn-primary tw-w-24"><i class="bi bi-calendar2-range"></i> Filter</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-repeat"></i></a>
            </div>
        </form>
    </div>    

    <x-table-card :title="'Daftar Peminjaman'">
        <x-slot name="headerActions">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <a href="{{ route('loans.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Buat Peminjaman
                </a>
                <a href="{{ route('loans.export.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
                
                {{-- <a href="{{ route('loans.export.pdf') }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a> --}}
            </div>
        </x-slot>
        
        <x-slot name="tableHeader">
            <tr>
                <th>ID</th>
                <th>Item</th>
                {{-- @if (Auth::user()->hasRole('Admin'))
                    <th>User</th>
                @endif --}}
                <th>Peminjam</th>
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
                    {{-- @if (Auth::user()->hasRole('Admin'))
                        <td>{{ $loan->user->name }}</td>
                    @endif --}}
                    <td>{{ $loan->nama_peminjam }}</td>
                    <td>{{ $loan->created_at }}</td>
                    <td>{{ $loan->return_date ?? 'Not returned yet' }}</td>
                    <td>{{ $loan->loan_duration }}</td>
                    <td>{{ $loan->quantity }}</td>
                    <td>
                        @if($loan->status == 'dipinjam')
                            <span class="badge bg-light-warning">Dipinjam</span>
                        @elseif($loan->status == 'dikembalikan')
                            <span class="badge bg-light-success">Dikembalikan</span>
                        @else
                            <span class="badge bg-light-secondary">{{ ucfirst($loan->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <!-- Trigger for Detail Modal -->
                        <button type="button" class="btn btn-light-info me-2 mb-2" data-bs-toggle="modal" data-bs-target="#loanModal{{ $loan->id }}">
                            <i class="bi bi-info-circle"></i> Detail
                        </button>
                        @can('Edit Loans')
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-light-warning me-2 mb-2">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        @endcan
                        @can('Delete Loans')
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light-danger me-2 mb-2" onclick="return confirm('Are you sure you want to delete this loan?')">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </form>
                        @endcan
                        @can('Manage Quantities')
                            @if($loan->status == 'pending')
                                <a href="{{ route('loans.manageQuantities', $loan->id) }}" class="btn btn-primary me-2 mb-2">
                                    <i class="bi bi-nut"></i> Atur
                                </a>
                            @endif
                        @endcan
                        @can('Return Items')
                            @if($loan->status == 'dipinjam')
                                <a href="{{ route('loans.returnItemsForm', $loan->id) }}" class="btn btn-success mb-2">
                                    <i class="bi bi-check2-all"></i> Kembalikan Barang
                                </a>
                            @endif
                        @endcan
                    </td>
                </tr>
                @include('pages.inner.loans.show', ['loan' => $loan])
            @endforeach
        </x-slot>
    </x-table-card>
</x-app-layout>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Jika ada nilai di filter (start_date atau end_date), pastikan form tetap terbuka
        let startDate = "{{ request('start_date') }}";
        let endDate = "{{ request('end_date') }}";
        
        if (startDate || endDate) {
            let filterForm = new bootstrap.Collapse(document.getElementById('filterForm'), {
                toggle: true
            });
            filterForm.show();
        }
    });
</script>
@endpush

