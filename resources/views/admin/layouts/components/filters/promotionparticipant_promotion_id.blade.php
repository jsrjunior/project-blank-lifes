<div class="form-group">
    {{ html()->label(__('ID da Promoção'), 'q[promotion_id][contains]') }}
    {{ html()->text('q[promotion_id][contains]', request()->input('q.promotion_id.contains'))->class('form-control') }}
</div>
