{{-- @php($statuses = $statuses->toArray()) --}}
@php(asort($statuses))

<div class="form-group">
    {{ html()->label(__($label ?? 'Status da conta'), 'q[customer_status_id][equals]') }}
    {{ html()->select('q[customer_status_id][equals]', $statuses, request()->input('q.customer_status_id.equals'))->placeholder('')->class('form-control') }}
</div>
