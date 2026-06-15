<?php

namespace App\Providers;

use App\Models\Comment; // <-- 1. WAJIB IMPORT INI DI ATAS BIAR GA EROR TARGET CLASS DOES NOT EXIST
use Illuminate\Support\Facades\View; // <-- 2. WAJIB IMPORT INI JUGA CUY
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
        // 3. DI SINI KITA PASANG FITUR HITUNG REALTIME-NYA:
        // Mengambil total baris data di tabel comments, lalu dibagikan ke semua blade dengan nama $totalComments
        View::share('totalComments', Comment::count());
    }
}