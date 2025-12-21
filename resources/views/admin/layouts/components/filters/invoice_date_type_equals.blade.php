@php
    $invoiceDateType = [
        'due_date' => __('Data de vencimento'),
        'payment_date' => __('Data de pagamento'),
        'competence_date' => __('Data de competência'),
    ];
@endphp

<div class="form-group">
    {{ html()->label(__($label ?? 'Tipo de data'), 'q[invoice_date_type][equals]') }}
    {{ html()->select('q[invoice_date_type][equals]', $invoiceDateType, request()->input('q.invoice_date_type.equals'))->placeholder('')->class('form-control') }}
</div>
