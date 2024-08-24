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
            'loan_duration' => 7,
            'quantity' => 2,
            'return_date' => null,
            'status' => 'pending',
        ]);

        Loan::create([
            'item_id' => 5,
            'user_id' => 3,
            'loan_duration' => 1,
            'quantity' => 3,
            'return_date' => null,
            'status' => 'borrowed',
        ]);

        Loan::create([
            'item_id' => 1,
            'user_id' => 3,
            'loan_duration' => 5,
            'quantity' => 6,
            'return_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'status' => 'returned',
        ]);
    }
}
