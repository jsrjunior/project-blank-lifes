<div class="form-group">
    <div class="custom-control custom-checkbox align-items-center">
        {{ html()->checkbox('q[only_not_registereds]', request()->input('q.only_not_registereds', false))->class(['custom-control-input', 'is-invalid' => $errors->has('q[only_not_registereds]')]) }}
        {{ html()->label(modelAttribute($type, 'only_not_registereds'), 'q[only_not_registereds]')->class('custom-control-label') }}
    </div>
</div>
