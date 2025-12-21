<div class="form-group">
    {{ html()->label(modelAttribute($type, 'approvalable_type'), 'q[approvalable_type][equals]') }}
    {{ html()->select('q[approvalable_type][equals]', $approvalable_type, request()->input('q.approvalable_type.equals'))->placeholder('')->class('form-control') }}
</div>
