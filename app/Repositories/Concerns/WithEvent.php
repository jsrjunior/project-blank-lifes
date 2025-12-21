<?php

namespace App\Repositories\Concerns;

use App\Events\ResourceUpdatedEvent;

trait WithEvent
{
    /**
     * Handles model after store.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterStore($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes, 'created');
    }

    /**
     * Handles model after update.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterUpdate($resource, $attributes)
    {
        return $this->afterSave($resource, $attributes, 'updated');
    }

    /**
     * Handles model after delete.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function afterDelete($resource)
    {
        event(new ResourceUpdatedEvent($resource->toEvent(), class_basename($resource)));

        return $resource;
    }

    /**
     * Handles model after restore.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function afterRestore($resource)
    {
        event(new ResourceUpdatedEvent($resource->toEvent(), class_basename($resource)));

        return $resource;
    }
}
