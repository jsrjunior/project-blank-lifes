<?php

namespace App\Repositories;

use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Events\ResourceCreatedEvent;
use App\Models\Approval;

class CrudRepository extends Repository
{
    /**
     * Display a listing of the resource.
     *
     * @param $params
     *
     * @return Collection|Model[]
     */
    public function index($params)
    {
        $cacheKey = 'filter_' . $this->getTable() . '_query_' . auth()->id();
        if (!request()->has('perPage')) {
            Cache::put($cacheKey, $params, 10);
        }

        $params = Cache::get($cacheKey, $params);

        $search = data_get($params, 'q');
        $with = data_get($params, 'with');
        $order = data_get($params, 'order');
        $perPage = request('perPage', config('app.database_parameters.paginate'));
        $paginate = request()->boolean('paginate', true);

        /* @noinspection PhpUndefinedMethodInspection */
        $return = $this->newQuery()
            ->select($this->indexColumns())
            ->filter([$this, 'indexFilter'])
            ->with($with ?? [])
            ->adminSearch($search)
            ->adminOrder($order);

        if ($paginate) {
          return $return->paginate($perPage)->appends($params);
        }

        return $return->get();
    }

    /**
     * Display a number of index registers in the resource.
     *
     * @param $params
     *
     * @return int
     */
    public function indexCount($params)
    {
        $search = data_get($params, 'q');
        $order = data_get($params, 'order');

        return $this->newQuery()
            ->select($this->indexColumns())
            ->filter([$this, 'indexFilter'])
            ->adminSearch($search)
            ->adminOrder($order)
            ->count();
    }

    /**
     * Export.
     *
     * @param $params
     *
     * @return Collection|Model[]
     */
    public function export($params)
    {
        $search = data_get($params, 'q');
        $order = data_get($params, 'order');

        /** @noinspection PhpUndefinedMethodInspection */
        $query = $this->newQuery()
            ->select($this->indexColumns())
            ->adminSearch($search)
            ->adminOrder($order);

        return $this->applyFilter($query, $params)
            ->paginate(1000);
    }

    /**
     * Columns to optimize index query.
     *
     * @return string|array
     */
    public function indexColumns()
    {
        return '*';
    }

    /**
     * Apply filter.
     *
     * @param Builder $query
     * @param array   $params
     *
     * @return Builder
     */
    public function applyFilter($query, $params)
    {
        return $query;
    }

    /**
     * Filter to optimize index query.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function indexFilter($query)
    {
        $params = request()->all();

        return $this->applyFilter($query, $params);
    }

    /**
     * Find the specified resource.
     *
     * @param int  $id
     * @param bool $trashed
     *
     * @return Model
     */
    public function find($id, $trashed = false, $failNotFound = true)
    {
        $query = $this->newQuery();

        /** @var Builder $query */
        /** @noinspection PhpUndefinedMethodInspection */
        $query = method_exists($this->getInstance(), 'getDeletedAtColumn') && $trashed
            ? $query->withTrashed() : $query;

        /* @noinspection PhpUndefinedMethodInspection */
        $query->select($this->findColumns())
            ->with($this->findWith())
            ->filter([$this, 'findFilter']);
        if ($failNotFound) {
            return $query->findOrFail($id);
        }

        return $query->find($id);
    }

    /**
     * Columns to optimize find query.
     *
     * @return string|array
     */
    public function findColumns()
    {
        return '*';
    }

    /**
     * Relations to optimize find query.
     *
     * @return array
     */
    public function findWith()
    {
        return [];
    }

    /**
     * Filter to optimize find query.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function findFilter($query)
    {
        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes = $this->beforeStore($this->createAttributes($attributes));

            /** @var Model $resource */
            $resource = $this->build($attributes, true);
            $resource->save();

            return $this->afterStore($resource, $attributes);
        });
    }

    /**
     * Store a many newly created resource in storage.
     *
     * @param array $group Group of attributes for create
     * @param array $common Attributes in common within the group of attributes that will be merged in creation
     *
     * @return void
     */
    public function createMany(array $group, array $common = [])
    {
        foreach ($group as $attributes) {
            $this->create(array_merge($attributes, $common));
        }
    }

    /**
     * Create on conflict.
     *
     * @param $attributes
     * @param null   $columnsToUpdate
     * @param string $type
     * @param null   $target
     *
     * @return mixed
     */
    public function createOnConflict($attributes, $columnsToUpdate = null, $type = 'do nothing', $target = null)
    {
        $attributes = $this->createAttributes($attributes);

        /** @var Model $resource */
        $resource = $this->build($attributes, true);

        $values = $resource->toArray();

        /* @var Builder $resource */
        return $this->getInstance()->insertOnConflict($values, $columnsToUpdate, $type, $target);
    }

    /**
     * Handles create action attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function createAttributes($attributes)
    {
        return $this->filterAttributes($attributes);
    }

    /**
     * Handles model before store.
     *
     * @param array $attributes
     *
     * @return array $attributes
     */
    public function beforeStore($attributes)
    {
        return $attributes;
    }

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
        return $this->afterSave($resource, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function update($resource, $attributes)
    {
        return DB::transaction(function () use ($resource, $attributes) {

            $attributes = $this->beforeUpdate($resource, $this->updateAttributes($attributes));

            /** @var Model $resource */
            if(!empty($resource))
            {
                $resource = $this->fill($resource, $attributes, true);
                $resource->save();
            }


            return $this->afterUpdate($resource, $attributes);
        });
    }

    /**
     * Handles model before update.
     *
     * @param array $attributes
     * @param Model $resource
     *
     * @return array $attributes
     */
    public function beforeUpdate($resource, $attributes)
    {
        return $attributes;
    }

    /**
     * Handles update action attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function updateAttributes($attributes)
    {
        return $this->filterAttributes($attributes);
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
        return $this->afterSave($resource, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function delete($resource)
    {
        return DB::transaction(function () use ($resource) {
            $resource = $this->beforeDelete($resource);

            $resource->delete();

            return $this->afterDelete($resource);
        });
    }

    /**
     * Delete a many resources in storage.
     *
     * @param mixed $resources Group of resources for delete
     *
     * @return void
     */
    public function deleteMany(mixed $resources)
    {
        foreach ($resources as $resource) {
            $this->delete($resource);
        }
    }

    /**
     * Handles model before delete.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function beforeDelete($resource)
    {
        return $resource;
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
        return $resource;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function restore($resource)
    {
        return DB::transaction(function () use ($resource) {
            $resource = $this->beforeRestore($resource);

            $resource->restore();

            return $this->afterRestore($resource);
        });
    }

    /**
     * Handles model before restore.
     *
     * @param Model $resource
     *
     * @return Model
     */
    public function beforeRestore($resource)
    {
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
        return $resource;
    }

    /**
     * Handles model after save.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterSave($resource, $attributes)
    {
        if(!empty($resource->getAppends()['approval_object']))
        {
           $approval = Approval::find($resource->getAppends()['approval_object']);
           $approval->approvalable_id = $resource->id;
           $approval->save();
        }
        return $resource;
    }

    /**
     * Filter attributes.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function filterAttributes($attributes)
    {
        return $attributes;
    }

    /**
     * Verifica se existe um registro com a condição fornecida.
     *
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions): bool
    {
        return $this->newQuery()->where($conditions)->exists();
    }

    /**
     *
     * Synchronizes the table with the attribute group. Update existing records, create new ones and delete records that are not in the group
     *
     * @param array $group Group with the attributes to be synchronized
     * @param mixed $model Model that will be synchronized
     * @param string $relationName Name of the relationship that will be synchronized
     * @param array $common Attributes in common within the group of attributes that will be merged in creation
     *
     * @return void
     */

    public function sync(array $group, mixed $model, string $relationName, array $common = [])
    {
        $keyName = app($this->resourceType)->getKeyName();

        $model->$relationName
            ->pluck($keyName)
            ->diff(collect($group)->pluck('id'))
            ->each(function ($id) use ($model, $relationName) {
                $model
                    ->$relationName()
                    ->findOrFail($id)
                    ->delete();
            });

        foreach ($group as $attributes) {
            $action = empty($attributes['id']) ? 'create' : 'update';
            if ($action === 'update') {
                $model->$relationName()
                    ->where($keyName, $attributes['id'])
                    ->$action(array_merge($attributes, $common));
            } else {
                $model->$relationName()
                    ->$action(array_merge($attributes, $common));
            }
        }
    }
}
