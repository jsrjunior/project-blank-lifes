@php(asort($claimStatuses))

<div class="form-group">
    {{ html()->label(__($label ?? 'Status'), 'q[claim_status_id][equals]') }}
    {{ html()->select('q[claim_status_id][equals]', $claimStatuses, request()->input('q.claim_status_id.equals'))->placeholder('')->class('form-control') }}
</div>
