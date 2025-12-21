@php(asort($claimTypes))

<div class="form-group">
    {{ html()->label(__($label ?? 'Tipo de acionamento'), 'q[claim_type_id][equals]') }}
    {{ html()->select('q[claim_type_id][equals]', $claimTypes, request()->input('q.claim_type_id.equals'))->placeholder('')->class('form-control') }}
</div>
