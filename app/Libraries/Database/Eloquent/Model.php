<?php

namespace App\Libraries\Database\Eloquent;

use App\Libraries\Database\Eloquent\Concerns\Fillable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Libraries\Database\Eloquent\Concerns\HasRelationships;
use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use App\Libraries\Database\Eloquent\Concerns\ArrayFilterable;
use App\Libraries\Database\Eloquent\Concerns\TranslateAdminColumns;
use App\Libraries\Database\Eloquent\Concerns\AdminLines;
use App\Libraries\Database\Eloquent\Concerns\AdminActionsButtons;
use App\Libraries\Database\Eloquent\Concerns\ActivitylogOptions;
use App\Repositories\WorkflowRepository;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Concerns\MustBeApproved;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;


abstract class Model extends Eloquent implements TableContract
{
    use ArrayFilterable;
    use AdminOrderable;
    use AdminSearchable;
    use Fillable;
    use Filterable;
    use HasColumns;
    use HasRoutes;
    use HasRelationships;
    use HasTranslations;
    use TranslateAdminColumns;
    use AdminLines;
    use AdminActionsButtons;
    use LogsActivity;
    use ActivitylogOptions;
    use MustBeApproved;


    protected $appends = ['approval_object'];

    // Método para obter o array $appends
    public function getAppends()
    {
        return $this->appends;
    }




    public function withDefaultActions()
    {
        return true;
    }

    public static function getTableName() {
        return (new static)->getTable();
    }

     /**
     * Get export repository.
     *
     * @return Repository
     */
    public function getRepository()
    {
        if ($this->repository) {
            $repositoryClass = $this->repository;
        } else {
            $model = $this;
            $repositoryClass = "App\\Repositories\\".class_basename($model)."Repository";
        }

        if (class_exists($repositoryClass)) {
            return new $repositoryClass();
        }

        return;
    }

    /**
     * Check if the workflow approval can be bypassed based on the presence in the workflow table.
     *
     * @return bool
     */
    public function isApprovalBypassed(): bool
    {
        if(!empty(user()->id) && user()->isSuper())
        {
            return user()->isSuper();
        }

        $className = get_class($this);
        $className = get_class($this);
        $exists = (new WorkflowRepository)->existsByWorkflowType($className);

        return !$exists;
    }

    /**
     * Verifica se a aprovação pode ser ignorada e retorna o valor 'before_or_after' se não for ignorada.
     *
     * @return mixed
     */
    public function checkApprovalBypass()
    {
        if (!$this->isApprovalBypassed()) {
            $className = get_class($this);
            $workflow = $this->workflowRepository->findByWorkflowType($className);
            if (!empty($workflow) && !empty($workflow->before_or_after)) {
                return $workflow->before_or_after; // Retorna o valor 'before_or_after' do fluxo de trabalho encontrado
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Verifica se há um UploadedFile no modelo.
     *
     * @return bool
     */
    public function hasUploadedFile()
    {
        foreach ($this->attributes as $attribute) {
            if ($this->$attribute instanceof UploadedFile) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the "approval object" attribute.
     *
     * @return mixed
     */
    public function getApprovalObjectAttribute() {
        // Sua lógica para determinar o valor de 'approval_object'
        // Exemplo: return $this->calculaAlgumValor();
        return [];
    }


}
