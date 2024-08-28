<?php

namespace App\Jobs;

use App\Models\Loan;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendLoanReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $user = User::find($this->loan->user_id);
        $client = new Client();

        $response = $client->post('https://api.fonnte.com/send', [
            'headers' => [
                'Authorization' => env('FONNTE_API_KEY'),
            ],
            'form_params' => [
                'target' => $this->loan->no_hp,
                'message' => 'Pengingat: Anda meminjam item dengan nama ' . $this->loan->item->name . ' dengan tenggat waktu sampai hari ini.',
                'schedule' => 0,
                'countryCode' => '62',
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            // Log error or handle error
        }
    }
}
