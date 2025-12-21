<?php

namespace App\Http\ViewComposers\Admin;

use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\View\View;

class UserViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles', (new RoleRepository())->rolesForUsers());
        $view->with('rolesForSelect', (new RoleRepository())->selectOptions());
        $view->with('types', User::getTypes()->toArray());
    }
}
