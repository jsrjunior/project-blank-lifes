<?php

namespace App\Http\Controllers\Admin;

use App\Models\Email;
use App\Models\EmailType;
use App\Models\Life;
use App\Repositories\EmailTypeRepository;
use App\Repositories\LifeRepository;

class EmailTypeController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = EmailType::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = EmailTypeRepository::class;
}