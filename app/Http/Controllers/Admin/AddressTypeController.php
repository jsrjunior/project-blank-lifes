<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddressType;
use App\Repositories\AddressTypeRepository;

class AddressTypeController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = AddressType::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = AddressTypeRepository::class;
}