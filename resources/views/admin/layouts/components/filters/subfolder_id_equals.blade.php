<div class="form-group">
    {{ html()->label(modelAttribute($type, 'subfolder_id'), 'q[subfolder_id][equals]') }}
    {{ html()->select('q[subfolder_id][equals]', $subfolders, request()->input('q.subfolder_id.equals'))->placeholder('')->class('form-control') }}
</div>
