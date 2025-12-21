<div class="form-group">
    {{ html()->label(__('Mensagem da Transação'), 'q[transactions--gateway_message][contains]') }}
    {{ html()->text('q[transactions--gateway_message][contains]', request()->input('q.transactions--gateway_message.contains'))->class('form-control') }}
</div>
