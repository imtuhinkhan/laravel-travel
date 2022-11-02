<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        view()->composer('partials.header', function ($view) {
            $createUrlForLocal = '';
            $lastTwoCharacterOfUrl  = substr(url()->current(), -2);
            if(in_array($lastTwoCharacterOfUrl,config('app.available_locales'))){
                $createUrlForLocal  = substr(url()->current(), 0,-3);

            }else{
                $createUrlForLocal = url()->current();
            }
            $view->with('urlForLocal', $createUrlForLocal);
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
