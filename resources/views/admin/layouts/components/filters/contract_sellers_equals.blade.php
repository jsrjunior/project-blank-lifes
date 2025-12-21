@php
    $sellers = $sellers->toArray();
    asort($sellers);
@endphp

<div class="form-group">
    {{ html()->label(__($label ?? 'Vendedor'), 'q[user_id][equals]') }}
    {{ html()->select('q[user_id][equals]', $sellers, request()->input('q.user_id.equals'))->placeholder('')->class('form-control') }}
</div>
