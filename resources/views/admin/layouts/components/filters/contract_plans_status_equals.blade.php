@php(asort($statuses))

<div class="form-group">
    {{ html()->label(__($label ?? 'Status do contrato'), 'q[subscriptions][status_id]') }}
    {{ html()->select('q[subscriptions][status_id]', $statuses, request()->input('q.subscriptions.status_id'))->placeholder('')->class('form-control') }}
</div>
