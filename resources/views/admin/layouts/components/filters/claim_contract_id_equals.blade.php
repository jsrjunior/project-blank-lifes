<div class="form-group">
    {{ html()->label(__($label ?? 'Contrato'), 'contract_id') }}
    {{ html()->text('q[contract_id]', request()->input('q.contract_id'))->placeholder('')->class('form-control') }}
</div>

