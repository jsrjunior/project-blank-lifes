<div class="form-group">
    {{ html()->label(__('Namespace'), 'q[namespace][contains]') }}
    {{ html()->text('q[namespace][contains]', request()->input('q.namespace.contains'))->class('form-control') }}
</div>
