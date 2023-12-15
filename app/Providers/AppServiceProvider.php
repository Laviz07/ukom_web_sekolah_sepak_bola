<?php

namespace App\Providers;

use App\Models\Pemain;
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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // View::composer('*', function ($view) {
        //     $nisn_pemain = request()->route('nisn_pemain');
        //     $pemain = Pemain::find($nisn_pemain);

        //     if ($pemain) {
        //         // Pemain ditemukan, maka Anda dapat mengakses propertinya
        //         $view->with('pemain', $pemain);
        //     }
        // });
    }
}
