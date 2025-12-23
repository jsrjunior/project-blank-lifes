<?php

namespace App\Http\ViewComposers\Admin;

use App\Models\AddressType;
use App\Models\DocumentType;
use App\Models\EmailType;
use App\Models\PhoneType;
use App\Models\User;
use App\Repositories\RoleRepository;
use Illuminate\View\View;

class LifeViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('emailTypes', EmailType::pluck('name','id'));
        $view->with('phoneTypes', PhoneType::pluck('name','id'));
        $view->with('addressTypes', AddressType::pluck('name','id'));
        $view->with('documentTypes', DocumentType::pluck('name','id'));
    }
}
