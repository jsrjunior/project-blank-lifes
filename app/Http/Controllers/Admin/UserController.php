<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = User::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = UserRepository::class;
}