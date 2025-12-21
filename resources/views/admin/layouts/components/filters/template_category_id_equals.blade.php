<div class="form-group">
    {{ html()->label(__('Categoria'), 'q[template_category_id][equals]') }}
    {{ html()->select('q[template_category_id][equals]', $template_categories, request()->input('q.template_category_id.equals'))->placeholder(null)->class('form-control') }}
</div>
