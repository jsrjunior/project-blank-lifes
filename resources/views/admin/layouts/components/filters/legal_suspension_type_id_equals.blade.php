<div class="form-group">
    {{ html()->label(__($label ?? 'Tipo'), 'q[legal_suspension_type_id][equals]') }}
    {{ html()->select('q[legal_suspension_type_id][equals]', $legalSuspensionTypes, request()->input('q.legal_suspension_type_id.equals'))->placeholder('')->class('form-control') }}
</div>
