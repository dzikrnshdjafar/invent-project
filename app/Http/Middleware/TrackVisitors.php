<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class TrackVisitors
{
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip(); // Mengambil alamat IP pengunjung

        // Cek apakah pengunjung ini sudah tercatat hari ini
        $visitorExists = Visitor::where('ip_address', $ipAddress)
            ->whereDate('visited_at', now()->toDateString())
            ->exists();

        // Jika belum tercatat, simpan ke database
        if (!$visitorExists) {
            Visitor::create([
                'ip_address' => $ipAddress,
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
