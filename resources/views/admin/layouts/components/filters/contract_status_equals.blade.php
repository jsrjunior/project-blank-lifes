@php(asort($contract_statuses))

<div class="form-group">
    {{ html()->label(__($label ?? 'Status financeiro'), 'q[contract_status_id][equals]') }}
    {{ html()->select('q[contract_status_id][equals]', $contract_statuses, request()->input('q.contract_status_id.equals'))->placeholder('')->class('form-control') }}
</div>
