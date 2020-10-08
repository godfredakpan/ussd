<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment() == 'production') {
            \URL::forceScheme('https');
            \URL::forceRootUrl(\Config::get('app.url'));
        }
        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });
    }
}
