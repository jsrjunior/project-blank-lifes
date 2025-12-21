<div class="form-group">
    {{ html()->label(__('Contrato'), 'q[contract_id][contains]') }}
    {{ html()->text('q[contract_id][contains]', request()->input('q.contract_id.contains'))->class('form-control') }}
</div>
