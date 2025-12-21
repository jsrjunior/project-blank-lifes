<div id="{{ isset($id) ? $id : $name }}" class="form-group {{ isset($class) ? $class : '' }} {{ isset($required) && $required ? 'required' : ''  }}">
    <div class="custom-control custom-checkbox align-items-center">
        <input type="hidden" name="{{ $name }}" value="0" />
        {{ html()->checkbox($name, isset($checked) ? $checked : null )
            ->attributeIf($disabled ?? false, 'disabled')
            ->class(['custom-control-input', 'is-invalid' => $errors->has($name)]) }}
        {{ html()->label($label ?? modelAttribute($type, $name), $name)->class('custom-control-label') }}
    </div>
    @include('admin.layouts.components.form.errors')
    {{ $slot }}

    <style>
        .custom-control-input
        {
            position: relative;
            z-index: 1;
            cursor: pointer; /* Muda o cursor para indicar que o elemento é clicável */
        }
    </style>
</div>
