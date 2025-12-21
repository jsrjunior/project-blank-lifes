<div class="form-group">
    {{ html()->label(__('Variável'), 'q[variable][contains]') }}
    {{ html()->text('q[variable][contains]', request()->input('q.variable.contains'))->class('form-control') }}
</div>
