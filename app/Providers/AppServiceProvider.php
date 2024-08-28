<?php

namespace App\Providers;

use App\Models\Loan;
use App\Models\Visitor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $pendingLoansCount = Loan::where('status', 'pending')->count();

            $ipAddress = request()->ip();

            Visitor::firstOrCreate(
                ['ip_address' => $ipAddress],
                [
                    'visited_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            // Statistik pengunjung
            $totalVisitors = Visitor::count();
            $todayVisitors = Visitor::whereDate('visited_at', now()->toDateString())->count();
            $yesterdayVisitors = Visitor::whereDate('visited_at', now()->subDay()->toDateString())->count();

            $view->with([
                "pendingLoansCount" => $pendingLoansCount,
                "totalVisitors" => $totalVisitors,
                "todayVisitors" => $todayVisitors,
                "yesterdayVisitors" => $yesterdayVisitors,
            ]);
        });
    }
}
