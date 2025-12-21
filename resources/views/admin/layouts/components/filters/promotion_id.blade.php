<div class="form-group">
    {{ html()->label(__('ID da Promoção'), 'q[id][contains]') }}
    {{ html()->text('q[id][contains]', request()->input('q.id.contains'))->class('form-control') }}
</div>
