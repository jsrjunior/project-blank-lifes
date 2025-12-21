<div class="form-group">
    {{ html()->label(modelAttribute($type, 'causer_id'), 'q[causer_id][equals]') }}
    {{ html()->select('q[causer_id][equals]', $causes, request()->input('q.causer_id.equals'))->placeholder('')->class('form-control') }}
</div>
