<div class="form-group">
    {{ html()->label(__('Código da Transação'), 'q[transactions--gateway_response_code][equals]') }}
    {{ html()->text('q[transactions--gateway_response_code][equals]', request()->input('q.transactions--gateway_response_code.equals'))->class('form-control') }}
</div>
