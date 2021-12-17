<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Blade::directive('money', function ($amount) {
            return "<?php echo '₦' . number_format($amount, 2); ?>";
        });

        Blade::directive('dateformat', function ($timestamp) {
            //dd($timestamp);
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp)->toDayDateTimeString();
            return "<?php echo $date ?>";
        });

        view()->composer('*',function($view){
            $view->with([
                'admin_source' => url('/').env('ASSET_URL').'/admins',
            ]);
        });
    }
}
