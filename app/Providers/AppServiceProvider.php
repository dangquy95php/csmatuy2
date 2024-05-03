<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        Validator::extend('without_spaces', function($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        Paginator::defaultView('vendor.pagination.bootstrap-4');
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-4');

        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate', 
                function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                    ->withPath('');
            });
        }
    }
}
