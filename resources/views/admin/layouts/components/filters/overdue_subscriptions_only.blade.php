@component('admin.layouts.components.form.input_checkbox')
    @slot('type', $type)
    @slot('name', 'overdue_subscriptions_only')
    @slot('checked', request()->query('overdue_subscriptions_only', false))
@endcomponent
