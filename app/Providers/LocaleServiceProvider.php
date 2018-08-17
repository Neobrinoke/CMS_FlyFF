<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap locale services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = LaravelLocalization::setLocale();

        Carbon::setLocale($locale);

        ViewFacade::composer('include.footer', function (View $view) use ($locale) {
            $locales = LaravelLocalization::getSupportedLocales();

            $view->with('locales', $locales);
            $view->with('currentLocale', $locales[$locale]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
