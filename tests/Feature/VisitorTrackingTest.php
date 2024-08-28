<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Visitor;

class VisitorTrackingTest extends TestCase
{
    use RefreshDatabase; // Menggunakan RefreshDatabase untuk memastikan database dalam kondisi bersih setiap test dijalankan

    public function test_it_increments_visitor_count_on_page_refresh()
    {
        $this->withoutExceptionHandling();

        // Menyertakan middleware secara eksplisit untuk pengujian ini
        $this->withMiddleware([
            \App\Http\Middleware\TrackVisitors::class,
        ]);

        // Pastikan tabel kosong sebelum test
        $this->assertCount(0, Visitor::all());

        // Refresh halaman pertama
        $this->get('/');
        $this->assertCount(1, Visitor::all());

        // Refresh halaman kedua
        $this->get('/');
        $this->assertCount(2, Visitor::all());

        // Refresh halaman ketiga
        $this->get('/');
        $this->assertCount(3, Visitor::all());
    }
}
