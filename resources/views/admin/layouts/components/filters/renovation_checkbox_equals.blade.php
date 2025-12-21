<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[renovation]', request()->input('q.renovation', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[renovation]')]) }}
        {{ html()->label(modelAttribute($type, 'renovation'), 'q[renovation]')->class('custom-control-label') }}
    </div>
</div>
