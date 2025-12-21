<?php

namespace App\Repositories\Concerns;

trait WithTypes
{
    /**
     * Get types on auxiliary resource.
     * @return array
     */

    public function getTypes(): array
    {
        return $this->newQuery()
            ->select('id', 'name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
