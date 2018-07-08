<?php

namespace App\Providers;

use App\Helper\ServerStatus;
use Illuminate\Pagination\Paginator;
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
