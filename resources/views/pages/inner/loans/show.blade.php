@props(['loan'])

<x-detail-modal :modalId="'loanModal'.$loan->id" :modalTitle="'Loan Details'">
    <x-slot name="slot">
        <p><strong>ID:</strong> {{ $loan->id }}</p>
        <p><strong>Item:</strong> {{ $loan->item->name }}</p>
        <p><strong>User:</strong> {{ $loan->user->name }}</p>
        <p><strong>Nama Peminjam:</strong> {{ $loan->nama_peminjam }}</p>
        <p><strong>Alamat:</strong> {{ $loan->alamat }}</p>
        <p><strong>NIP/NIK:</strong> {{ $loan->nip_nik }}</p>
        <p><strong>No HP:</strong> {{ $loan->no_hp }}</p>
        <p><strong>Durasi Peminjaman (days):</strong> {{ $loan->loan_duration }}</p>
        <p><strong>Tanggal Pengembalian:</strong> {{ $loan->return_date ?? 'Belum dikembalikan' }}</p>
        <p><strong>Kuantitas:</strong> {{ $loan->quantity }}</p>
        <p><strong>Status:</strong> {{ ucfirst($loan->status) }}</p>
        <p><strong>Keterangan:</strong> {{ $loan->keterangan ?? 'N/A' }}</p>
    </x-slot>
    <x-slot name="footer">
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Close</a>
    </x-slot>
</x-detail-modal>
