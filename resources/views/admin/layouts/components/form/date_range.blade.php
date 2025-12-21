@php
$v1 = null;
$v2 = null;
if(isset($value) && is_array($value)){
    if($value[0])
        $v1 = \Carbon\Carbon::parse($value[0])->format('d/m/Y');
    if($value[1])
        $v2 = \Carbon\Carbon::parse($value[1])->format('d/m/Y');
}

@endphp
<div class="form-group {{ isset($required) && $required ? 'required' : '' }} {{ $class ?? '' }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    <div class="input-group">
        {{ html()->text($name, $v1 ?? null)->class(['form-control', 'date-picker', 'is-invalid' => $errors->has($name)])->attribute('autocomplete', 'off')->attributeIf($required ?? false, 'required')->attributeIf($disabled ?? false, 'disabled') }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
        @include('admin.layouts.components.form.errors')
        {{ $slot }}
      {{ html()->text($name, $v2 ?? null)->class(['form-control', 'date-picker', 'is-invalid' => $errors->has($name)])->attribute('autocomplete', 'off')->attributeIf($required ?? false, 'required')->attributeIf($disabled ?? false, 'disabled') }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
        @include('admin.layouts.components.form.errors')
        {{ $slot }}
    </div>
</div>
