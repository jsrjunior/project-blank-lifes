<div class="form-group">
    {{ html()->label(__($label ?? 'Gateway'), 'q[payment_company_id][equals]') }}
    {{ html()->select('q[payment_company_id][equals]', $paymentCompany, request()->input('q.payment_company_id.equals'))->placeholder('')->class('form-control') }}
</div>
