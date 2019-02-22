<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('files_count', function ($attribute, $value, $parameters, $validator) {
            $maxCount = $parameters[0];

            return count($value) <= $maxCount;
        });

        Validator::replacer('files_count', function($message, $attribute, $rule, $parameters){
            return str_replace(':max_count', $parameters[0], $message);
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
