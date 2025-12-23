<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SaveLifeRequest;
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

    /**
     * Returns the request that should be used to validate.
     *
     * @return FormRequest
     */
    protected function formRequest()
    {
        return app(SaveLifeRequest::class);
    }
}