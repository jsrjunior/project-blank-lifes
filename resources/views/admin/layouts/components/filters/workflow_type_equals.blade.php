<div class="form-group">
    {{ html()->label(modelAttribute($type, 'workflow_type'), 'q[workflow_type][equals]') }}
    {{ html()->select('q[workflow_type][equals]', $workflow_type, request()->input('q.workflow_type.equals'))->placeholder('')->class('form-control') }}
</div>
