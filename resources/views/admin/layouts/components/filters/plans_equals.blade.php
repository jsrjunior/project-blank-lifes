@php(asort($contract_plans))

<div class="form-group">
    {{ html()->label(__($label ?? 'Cobertura'), 'q[subscriptions][plan_id]') }}
    {{ html()->select('q[subscriptions][plan_id]', $contract_plans, request()->input('q.subscriptions.plan_id'))->placeholder('')->class('form-control') }}
</div>
