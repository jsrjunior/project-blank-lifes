<div class="form-group">
    {{ html()->label(__('Nome'), 'q[first_name][contains]') }}
    {{ html()->text('q[first_name][contains]', request()->input('q.first_name.contains'))->class('form-control') }}
</div>

<div class="form-group">
    {{ html()->label(__('Sobrenome'), 'q[last_name][contains]') }}
    {{ html()->text('q[last_name][contains]', request()->input('q.last_name.contains'))->class('form-control') }}
</div>

