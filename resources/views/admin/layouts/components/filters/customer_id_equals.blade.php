<div class="form-group">
    {{ html()->label(__('Cliente'), 'q[customer_id][equals]') }}
    {{ html()->text('q[customer_id][equals]', request()->input('q.customer_id.equals'))->class('form-control mask-integer') }}
</div>
