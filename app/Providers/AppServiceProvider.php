<?php

namespace App\Providers;

use App\Libraries\Breadcrumbs\Breadcrumbs;
use App\Libraries\Html\Html;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('breadcrumbs', function () {
            return (new Breadcrumbs())->setAttribute('class', 'breadcrumb');
        });

        $this->app->singleton(Html::class, function () {
            return new Html(request());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
