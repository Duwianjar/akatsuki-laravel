<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('not_html_or_hyphen_or_single_quote', function ($attribute, $value, $parameters, $validator) {
            // Validasi bahwa nilai tidak mengandung karakter HTML berbahaya, -
            // atau ' (single quote)
            return !preg_match('/<\/?[a-z][\s\S]*>|[-\']/', $value);
        });
    }
}
