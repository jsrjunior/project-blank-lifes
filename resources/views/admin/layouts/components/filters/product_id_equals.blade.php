<div class="form-group">
    {{ html()->label(__('Produto'), 'q[product_id][equals]') }}
    {{ html()->select('q[product_id][equals]', $products, request()->input('q.product_id.equals'))->placeholder(null)->class('form-control') }}
</div>
