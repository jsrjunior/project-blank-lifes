<?php

namespace App\Http\Controllers\Admin;

use App\Models\Life;
use App\Models\Phone;
use App\Models\PhoneType;
use App\Repositories\PhoneTypeRepository;

class PhoneTypeController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = PhoneType::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = PhoneTypeRepository::class;
}