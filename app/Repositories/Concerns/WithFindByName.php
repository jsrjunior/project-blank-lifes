<?php

namespace App\Repositories\Concerns;

trait WithFindByName
{
    /**
     * Return first resource by "name" column
     *
     * @param string $name value of "name" column
     * 
     * @return mixed|null
     */
    public function findByName(string $name)
    {
        return $this->newQuery()->where('name', $name)->first();
    }
}
