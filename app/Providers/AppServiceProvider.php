<?php

namespace App\Providers;

use App\Support\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Vite::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('vite', function ($expression) {
            return "<?php echo app('".Vite::class."')->tags($expression); ?>";
        });
    }
}
