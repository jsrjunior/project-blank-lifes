<?php

namespace App\Repositories\Concerns;

use Illuminate\Support\Facades\DB;

trait WithActions
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
        return $this->afterSave($resource, $attributes, 'create');
    }

    /**
     * Handles model after update.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterUpdate($resource, $attributes, $action = null)
    {
        return $this->afterSave($resource, $attributes, $action);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function update($resource, $attributes, $action = null)
    {
        return DB::transaction(function () use ($resource, $attributes, $action) {

            $attributes = $this->beforeUpdate($resource, $this->updateAttributes($attributes));

            /** @var Model $resource */
            if(!empty($resource))
            {
                $resource = $this->fill($resource, $attributes, true);
                $resource->save();
            }

            return $this->afterUpdate($resource, $attributes, $action);
        });
    }
}
