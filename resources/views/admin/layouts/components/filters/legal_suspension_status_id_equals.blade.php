<div class="form-group">
    {{ html()->label(__($label ?? 'Status'), 'q[legal_suspension_status_id][equals]') }}
    {{ html()->select('q[legal_suspension_status_id][equals]', $legalSuspensionStatuses, request()->input('q.legal_suspension_status_id.equals'))->placeholder('')->class('form-control') }}
</div>
