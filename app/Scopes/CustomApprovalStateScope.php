<?php

namespace App\Scopes;

use Cjmellor\Approval\Scopes\ApprovalStateScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Cjmellor\Approval\Enums\ApprovalStatus;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Relations\Relation;

class CustomApprovalStateScope extends ApprovalStateScope
{
    /**
     * Sobrescrever o método approve para adicionar funcionalidades adicionais
     */
    protected function addApprove(Builder $builder): void
    {
        $builder->macro('approve', function (Builder $builder, bool $persist = true) {
            if ($persist) {
                $modelClass = $builder->getModel()->approvalable_type;
                $modelId = $builder->getModel()->approvalable_id;
                $morphedModel = Relation::getMorphedModel($modelClass) ?? $modelClass;
                $model = new $morphedModel();

                if ($modelId) {
                    $model = $model::withTrashed()->find($modelId);
                }

                $newData = $builder->getModel()->new_data->toArray();

                foreach ($newData as $key => $value) {
                    $newData[$key] = $model->callCastAttribute($key, $value);
                }

                if(!empty($model->deleted_at))
                {
                    $model->deleted_at = null;
                    $model->save();
                    $builder->getModel()->update(['approvalable_id' => $model->id]);

                }

                $model->forceFill($newData);
                $model->withoutApproval()->save();

                // Funcionalidade customizada: Atualizar o approvalable_id após salvar o modelo
                $builder->getModel()->update(['approvalable_id' => $model->id]);
            }

            return $this->updateApprovalState($builder, state: ApprovalStatus::Approved);
        });
    }

    /**
     * Opcionalmente, modificar o método updateApprovalState se necessário
     */
    protected function updateApprovalState(Builder $builder, ApprovalStatus $state): int
    {
        if($state === ApprovalStatus::Approved)
        {
            $builder->find(id: $builder->getModel()->id)->update([
                'new_data' => $builder->getModel()->original_data,
                'original_data' => $builder->getModel()->new_data,
            ]);
        }

        return parent::updateApprovalState($builder, $state);
    }
}
