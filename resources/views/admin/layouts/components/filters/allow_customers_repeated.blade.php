<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[allow_customers_repeated]', request()->input('q.allow_customers_repeated', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[allow_customers_repeated]')]) }}
        {{ html()->label(modelAttribute($type, 'allow_customers_repeated'), 'q[allow_customers_repeated]')->class('custom-control-label') }}
    </div>
</div>
