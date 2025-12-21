@php
    if(Request::query('invoice_date')){
        $dateRange = Request::query('invoice_date');
        $date = explode(' - ', $dateRange);

        $beginDate = data_get($date, 0);
        $endDate = data_get($date, 1);

        $beginDate = $beginDate
            ? now()->createFromFormat('d/m/Y', $beginDate)
            : now();
        $endDate = $endDate
            ? now()->createFromFormat('d/m/Y', $endDate)
            : now();

        $beginDate->startOfDay();
        $endDate->startOfDay();
    }

@endphp
@component('admin.layouts.components.filters.date_range')
   @slot('name', 'invoice_date')
   @slot('label', 'Data')
   @slot('beginDate', $beginDate ?? null)
   @slot('endDate', $endDate ?? null)
@endcomponent
