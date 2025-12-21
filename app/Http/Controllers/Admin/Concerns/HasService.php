<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait HasService
{
    protected function getService($params = null)
    {
        if ($this->serviceType) {
            return new $this->serviceType($params);
        }

        return null;
    }
}
