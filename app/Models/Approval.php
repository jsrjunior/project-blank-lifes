<?php

namespace App\Models;
use Cjmellor\Approval\Models\Approval as BaseApproval;
use App\Models\Concerns\WithIdAdminColumn;
use Illuminate\Support\Facades\Route;
use App\Models\Concerns\WithTitleAdminColumn;
use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use Cjmellor\Approval\Enums\ApprovalStatus;
use App\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Event;
use App\Scopes\CustomApprovalStateScope;
use Cjmellor\Approval\Events\ModelRolledBackEvent;
use Carbon\Carbon;
use Closure;
use Exception;


class Approval extends BaseApproval implements TableContract
{
    use AdminOrderable;
    use AdminSearchable;
    use Filterable;
    use HasColumns;
    use BelongsToUser;
    use HasRoutes;
    use HasTranslations;
    use WithIdAdminColumn;
    use WithTitleAdminColumn;

    protected $casts = [
        'new_data' => 'array',
    ];
   
    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        // Cria o array básico com os campos padrão
        $array = [
            'id',
            // 'approvable--id', // Codigo da Solicitação
            'contract_id', // ID do Contrato
            'state', // Status
            'approvable--type', // Setor 
            'requested_by', //Solicitante
            'roles', // Papeis do Solicitante
            'new_data', // Motivo
            'audited_by', // Revisado por
            'audited_by--roles', // Papeis do Revisor
            'created_at', // Data de Criação
            'rolled_back_at', // Data de Atualização
        ];

        // Verifica se o usuário tem permissão para gerenciar aprovações
        if (user()->can("manage approvals"))
        {
            // Adiciona 'checkbox' no início do array se o usuário tem permissão
            array_unshift($array, 'checkbox');
        }

        return $array;
    }

    public function getApprovableTypeAdminColumn()
    {

        return modelName($this->approvalable_type);

    }

    public function getApprovableIdAdminColumn()
    {
        $routeName = 'web.admin.' . (new $this->approvalable_type)->getTable() . '.show';

        // Verifica se a rota existe
        if (Route::has($routeName) && !empty($this->approvalable_id)) {
            $link = route($routeName, ['id' => $this->approvalable_id]);
            return html()->a($link, '#' . $this->approvalable_id)->data('pjax', true);
        }

        return $this->approvalable_id;
    }

    public function getStateAdminColumn()
    {
        // return translateApprovalStatus($this->state);
        $statuses = [
            'pending' => 'Pendente',
            'rejected' => 'Rejeitado',
            'approved' => 'Aprovado',
        ];

        return $statuses[$this->state] ?? 'Desconhecido';
    }

    public function getRolledBackAtAdminColumn()
    {

        return $this->updated_at;
    }

    public function getAuditedByAdminColumn()
    {
        return $this?->user?->name;

    }

    public function getCheckboxAdminColumn()
    {
        return <<<HTML
        <div id="consent_required" class="form-group">
            <div class="custom-control custom-checkbox align-items-center">
                <input type="hidden" name="approvals[]" value="0" />
                <input type="checkbox" name="approvals[]" class="custom-control-input is-invalid" value="{$this->id}">
                <label for="approvals" class="custom-control-label"></label>
            </div>
            <!-- Erros serão incluídos aqui se houver -->
            <div>
                <!-- Mensagem de erro, se aplicável -->
            </div>
            <!-- Aqui ficariam outros slots adicionais, se fossem definidos -->

            <style>
                .custom-control-input {
                    position: relative;
                    z-index: 1;
                    cursor: pointer; /* Muda o cursor para indicar que o elemento é clicável */
                }
            </style>
        </div>
        HTML;

    }

    public function getRequestedByAdminColumn()
    {
        return $this?->requestedBy?->name;
    }

    /**
     * Get roles admin column
     *
     * @param bool $export
     * @return string
     */
    public function getRolesAdminColumn($export = false)
    {
        return $this?->requestedBy?->roles->pluck('name')->join(', ');
    }
    
    /**
     * Get roles admin column
     *
     * @param bool $export
     * @return string
     */
    public function getAuditedByRolesAdminColumn($export = false)
    {
       return $this?->user?->roles->pluck('name')->join(', ');
    }

    public function getAdminActions()
    {
        $actions = '';
        $csrfToken = csrf_token(); // Assume que está no contexto do Laravel para gerar token CSRF

        if(user()->can("manage approvals"))
        {
            if($this->approvalable_type != 'App\Models\DependentFollowup')
            {
                if($this->state == ApprovalStatus::Pending)
                {

                    $approveUrl = route('web.admin.approvals.approve', $this->id);
                    $rejectUrl = route('web.admin.approvals.reject', $this->id);

                    // Verifica se o usuário tem permissão para aprovar
                    if (user()->can('approve ' . (new $this->approvalable_type)->getTable()))
                    {
                        // Botão de Aprovar
                        $actions .= '<form method="POST" action="' . $approveUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        $actions .= '<button type="submit" class="btn btn-success btn-sm ml-1" data-toggle="tooltip" title="Aprovar">';
                        $actions .= '<i class="fa fa-check"></i> ';
                        if (Route::currentRouteName() == 'web.admin.approvals.show') {
                            $actions .= ' Aprovar';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }

                    // Verifica se o usuário tem permissão para rejeitar
                    if (user()->can('reject ' . (new $this->approvalable_type)->getTable()))
                    {
                        // Botão de Rejeitar
                        $actions .= '<form method="POST" action="' . $rejectUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        $actions .= '<button type="submit" class="btn btn-danger btn-sm ml-1" data-toggle="tooltip" title="Rejeitar">';
                        $actions .= '<i class="fa fa-times"></i> ';
                        if (Route::currentRouteName() == 'web.admin.approvals.show') {
                            $actions .= ' Rejeitar';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }

                }else
                {
                    if (user()->can('rollback ' . (new $this->approvalable_type)->getTable()))
                    {
                        // Botão de Rollback
                        $rollbackUrl = route('web.admin.approvals.rollback', $this->id);
                        $actions .= '<form method="POST" action="' . $rollbackUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        // $actions .= '<button type="submit" class="btn btn-warning btn-sm ml-1" data-toggle="tooltip" title="Reverter">';
                        // $actions .= '<i class="fa fa-undo"></i> ';
                        if(Route::currentRouteName() == 'web.admin.approvals.show' )
                        {
                            $actions .= ' Reverter';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }

                }
            }else
            {

                $approveUrl = route('web.admin.dependent_followups.followupApprove');
                $disapproveUrl = route('web.admin.dependent_followups.followupDisapprove');
                $rollbackUrl = route('web.admin.dependent_followups.followupRollback');
                if ($this->state == ApprovalStatus::Pending)
                {
                    // Botão de Aprovar
                    if (user()->can('approve dependent_followups'))
                    {
                        $actions .= '<form method="POST" action="' . $approveUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        $actions .= '<input type="hidden" name="followupId" value="' . $this->approvalable_id . '">';
                        $actions .= '<button type="submit" class="btn btn-success btn-sm ml-1" data-toggle="tooltip" title="Aprovar">';
                        $actions .= '<i class="fa fa-check"></i> ';
                        if (Route::currentRouteName() == 'web.admin.approvals.show')
                        {
                            $actions .= ' Aprovar';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }
                    // Botão de Reprovar
                    if (user()->can('reject dependent_followups'))
                    {
                        $actions .= '<form method="POST" action="' . $disapproveUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        $actions .= '<input type="hidden" name="followupId" value="' . $this->approvalable_id . '">';
                        $actions .= '<button type="submit" class="btn btn-danger btn-sm ml-1" data-toggle="tooltip" title="Reprovar">';
                        $actions .= '<i class="fa fa-times"></i> ';
                        if (Route::currentRouteName() == 'web.admin.approvals.show')
                        {
                            $actions .= ' Reprovar';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }
                } else
                {
                    // Botão de Reverter
                    if (user()->can('rollback dependent_followups'))
                    {
                        $actions .= '<form method="POST" action="' . $rollbackUrl . '" style="display: inline-block;">';
                        $actions .= '<input type="hidden" name="_token" value="' . $csrfToken . '">';
                        $actions .= '<input type="hidden" name="followupId" value="' . $this->approvalable_id . '">';
                        $actions .= '<button type="submit" class="btn btn-warning btn-sm ml-1" data-toggle="tooltip" title="Reverter">';
                        $actions .= '<i class="fa fa-undo"></i> ';
                        if (Route::currentRouteName() == 'web.admin.approvals.show')
                        {
                            $actions .= ' Reverter';
                        }
                        $actions .= '</button>';
                        $actions .= '</form>';
                    }
                }

            }

        }

        return $actions;
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
        return ['id', 'name', 'before_or_after'];
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
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'audited_by');
    }

    /**
     * Represents a database relationship.
     *
     * @return BelongsTo|Builder|User
    */
    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public static function booted(): void
    {
        static::addGlobalScope(new CustomApprovalStateScope());
    }

    /**
     * Retorna uma lista de todos os tipos únicos de 'approvalable_type' cadastrados.
     *
     * @return array
     */
    public function getUniqueApprovalableTypes()
    {
        $array = self::query()
                   ->distinct()
                   ->pluck('approvalable_type')
                   ->toArray();
            $mappedTypes = [];
            foreach($array as $a)
            {
                $mappedTypes[$a] = modelName($a);
            }
        return $mappedTypes;
    }

    public function rollback(Closure $condition = null, $bypass = true): void
    {
        if ($this->new_data->count() === 0 && !empty($this->approvalable_id) && $this->state === ApprovalStatus::Approved)
        {
            $model = new $this->approvalable_type;

            $model = $model::withTrashed()->find($this->approvalable_id);
            $model->deleted_at = now();
            $model->save();

            $this->update([
                'state' => ApprovalStatus::Pending,
                'new_data' => $this->original_data,
                'original_data' => $this->new_data,
                'rolled_back_at' => now(),
            ]);

        }

        if($this->state === ApprovalStatus::Rejected)
        {
            $this->update([
                'state' => ApprovalStatus::Pending,
                'rolled_back_at' => now(),
            ]);
        }
    }
}
