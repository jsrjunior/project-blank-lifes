<div class="form-group">
    {{ html()->label(__($label ?? 'Status'), 'q[invoice_status_id][equals]') }}
    {{ html()->select('q[invoice_status_id][equals]', $invoiceStatus, request()->input('q.invoice_status_id.equals'))->placeholder('')->class('form-control') }}
</div>
