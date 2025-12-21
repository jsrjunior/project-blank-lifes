<?php

namespace App\Http\Controllers\Admin;

use App\Models\Life;
use App\Repositories\LifeRepository;

class LifeController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Life::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = LifeRepository::class;
}