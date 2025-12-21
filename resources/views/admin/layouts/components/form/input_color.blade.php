<div class="form-group {{ $class ?? null }} {{ isset($required) && $required ? 'required' : ''  }}">
    <div class="custom-control custom-radio align-items-center" style="padding-left:0">
        {{-- {{ html()->color($name, $checked, $value)->disabled(isset($disabled))->required(isset($required) && $required) }}&nbsp; --}}
        <input type="color" name={{$name}} value={{$value ?? "#000000"}} required={{$required ?? false}}>
        {{ html()->label($label)->class(isset($disabled) ? 'text-gray-300' : null) }}
    </div>
    {{ $slot }}
</div>
