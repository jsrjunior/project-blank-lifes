<?php

namespace App\Models;

use App\Events\ResourceCreatedEvent;
use App\Events\ResourceUpdatedEvent;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithWorkflowTypeAdminColumn;
use App\Models\Concerns\WithTitleAdminColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\Relations\HasManyWorkflowModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Container\Container;

class Workflow extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use WithIdAdminColumn;
    use WithWorkflowTypeAdminColumn;

    use WithTitleAdminColumn;
    use HasManyWorkflowModels;



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => ResourceCreatedEvent::class,
        'updated' => ResourceUpdatedEvent::class,
        'deleted' => ResourceUpdatedEvent::class,
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'before_or_after', 'created_at', 'workflow--type'];
    }

    /**
     * If this column should expand.
     *
     * @param int    $index
     * @param string $FullAttribute
     *
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['name']);
    }

    /**
     * Get available ordering fields.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'created_at', 'before_or_after', 'workflow--type'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'created_at';
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
     * Get subject type options
     *
     * @return array
     */
    public function subjectTypeOptions()
    {
        $appNamespace = Container::getInstance()->getNamespace();
        $modelNamespace = 'Models';

        $models = collect(File::allFiles(app_path($modelNamespace)))->map(function ($item) use ($appNamespace, $modelNamespace) {
            $rel   = $item->getRelativePathName();
            $class = sprintf(
                '%s%s%s',
                $appNamespace,
                $modelNamespace ? $modelNamespace . '\\' : '',
                implode('\\', explode('/', substr($rel, 0, strrpos($rel, '.'))))
            );
            return class_exists($class) ? $class : null;
        })->filter();

        $options = [];

        foreach ($models as $model) {

            $key = 'models.' . $model . '.actions.label';
            if (Lang::has($key)) {
                $options[$model] = trans($key);
            }
        }

        asort($options);

        return $options;
    }
}

