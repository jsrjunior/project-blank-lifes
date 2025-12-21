<div class="form-group">
    {{ html()->label(__('Id do cliente'), 'q[customer_id][equals]') }}
    {{ html()->text('q[customer_id][equals]', request()->input('q.customer_id.equals'))->class('form-control mask-integer') }}
</div>
