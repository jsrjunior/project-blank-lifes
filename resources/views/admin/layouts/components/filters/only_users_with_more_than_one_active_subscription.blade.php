<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_users_with_more_than_one_active_subscription]', request()->input('q.only_users_with_more_than_one_active_subscription', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_users_with_more_than_one_active_subscription]')]) }}
        {{ html()->label(modelAttribute($type, 'only_users_with_more_than_one_active_subscription'), 'q[only_users_with_more_than_one_active_subscription]')->class('custom-control-label') }}
    </div>
</div>
