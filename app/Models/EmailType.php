<?php

namespace App\Models;

use App\Events\ResourceCreatedEvent;
use App\Events\ResourceUpdatedEvent;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithNameAdminColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailType extends Model
{

    use SoftDeletes;
    use WithIdAdminColumn;
    use WithNameAdminColumn;
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => ResourceCreatedEvent::class,
        'updated' => ResourceUpdatedEvent::class,
        'deleted' => ResourceUpdatedEvent::class,
    ];

    protected $fillable = [
        'name',
    ];

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'created_at'];
    }

    /**
     * If this column should expand.
     *
     * @param int    $index
     * @param string $attribute
     *
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['name']);
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'id';
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'desc';
    }

    /**
     * Get export model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass();
    }
}