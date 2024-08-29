<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loan::create([
            'item_id' => 4,
            'user_id' => 3,
            'nama_peminjam' => 'John Doe',
            'alamat' => 'Jl. Pahlawan No. 123, Jakarta',
            'nip_nik' => '1234567890',
            'no_hp' => '08126712652',
            'loan_duration' => 7,
            'quantity' => 2,
            'return_date' => null,
            'status' => 'pending',
            'keterangan' => 'Pinjaman untuk keperluan kantor',
        ]);

        Loan::create([
            'item_id' => 5,
            'user_id' => 3,
            'nama_peminjam' => 'Jane Smith',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'nip_nik' => '0987654321',
            'no_hp' => '89762398',
            'loan_duration' => 1,
            'quantity' => 3,
            'return_date' => null,
            'status' => 'dipinjam',
            'keterangan' => 'Pinjaman untuk acara pameran',
        ]);

        Loan::create([
            'item_id' => 1,
            'user_id' => 3,
            'nama_peminjam' => 'Alice Johnson',
            'alamat' => 'Jl. Merdeka No. 5, Surabaya',
            'nip_nik' => '1122334455',
            'no_hp' => '09812363',
            'loan_duration' => 5,
            'quantity' => 6,
            'return_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'status' => 'dikembalikan',
            'keterangan' => 'Pinjaman untuk seminar',
        ]);
    }
}
