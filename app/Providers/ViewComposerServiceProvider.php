<?php

namespace App\Providers;

use App\Http\ViewComposers\Admin\RoleViewComposer;
use App\Http\ViewComposers\Admin\UserViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.roles.*', RoleViewComposer::class);
        View::composer('admin.users.*', UserViewComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {}
}
