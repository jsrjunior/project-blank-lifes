<div class="form-group">
    {{ html()->label(__('Element Name'), 'q[element_name][contains]') }}
    {{ html()->text('q[element_name][contains]', request()->input('q.element_name.contains'))->class('form-control') }}
</div>
