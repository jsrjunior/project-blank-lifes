<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_show_plans_active_subscriptions]', request()->input('q.only_show_plans_active_subscriptions', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_show_plans_active_subscriptions]')]) }}
        {{ html()->label(modelAttribute($type, 'only_show_plans_active_subscriptions'), 'q[only_show_plans_active_subscriptions]')->class('custom-control-label') }}
    </div>
</div>
