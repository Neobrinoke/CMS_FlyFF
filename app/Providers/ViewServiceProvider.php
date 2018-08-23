<?php

namespace App\Providers;

use App\Helper\ServerStatus;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ViewFacade::composer('*', function (View $view) {
            $view->with('loggedUser', auth()->user());
        });

        ViewFacade::composer('layout', function (View $view) {
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
