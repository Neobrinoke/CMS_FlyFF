<?php

namespace App\Providers;

use App\Helper\ServerStatus;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('include.pagination');

        ViewFacade::composer('*', function (View $view) {
            $view->with('loggedUser', auth()->user());
        });

        ViewFacade::composer('include.aside', function (View $view) {
            $view->with('serverStatus', app(ServerStatus::class));
        });

        Carbon::setLocale(config('app.locale'));

        Validator::extend('upload_count', function ($attribute, $value, $parameters, $validator) {
            return count($value) >= intval($parameters[0]);
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
