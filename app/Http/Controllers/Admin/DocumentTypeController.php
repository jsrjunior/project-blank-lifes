<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddressType;
use App\Models\DocumentType;
use App\Repositories\AddressTypeRepository;
use App\Repositories\DocumentTypeRepository;

class DocumentTypeController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = DocumentType::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = DocumentTypeRepository::class;
}