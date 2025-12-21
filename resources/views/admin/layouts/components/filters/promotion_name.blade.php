<div class="form-group">
    {{ html()->label(__('Nome da Promoção'), 'q[name][contains]') }}
    {{ html()->text('q[name][contains]', request()->input('q.name.contains'))->class('form-control') }}
</div>
