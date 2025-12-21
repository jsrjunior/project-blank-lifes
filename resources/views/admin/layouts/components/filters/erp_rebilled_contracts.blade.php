@component('admin.layouts.components.form.input_checkbox')
    @slot('type', $type)
    @slot('name', 'erp_rebilled_contracts')
    @slot('checked', request()->query('erp_rebilled_contracts', false))
@endcomponent
