<div class="form-group">
    {{ html()->label(__($label ?? 'Forma de pagamento'), 'q[payment_method_id][equals]') }}
    {{ html()->select('q[payment_method_id][equals]', $paymentMethod, request()->input('q.payment_method_id.equals'))->placeholder('')->class('form-control') }}
</div>
