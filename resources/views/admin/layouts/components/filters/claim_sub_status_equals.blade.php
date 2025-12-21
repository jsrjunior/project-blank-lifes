@php(asort($claimSubStatuses))

<div class="form-group">
    {{ html()->label(__($label ?? 'Substatus'), 'claim_sub_status_id') }}
    {{ html()->select('q[claim_sub_status_id]', $claimSubStatuses, request()->input('q.claim_sub_status_id'))->placeholder('')->class('form-control') }}


</div>
