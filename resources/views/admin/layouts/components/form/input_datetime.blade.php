@php
    // Geramos um ID único para o container
    $uniqueId = 'dtp_' . $name . '_' . Str::random(5);
@endphp

<div class="form-group {{ isset($required) && $required ? 'required' : ''  }} {{ $class ?? '' }}">
    @if (!isset($label) || $label !== '')
        {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    @endif
    
    <div class="input-group date" id="{{ $uniqueId }}" data-target-input="nearest">
        {{ html()->text($name, $value ?? null)
            ->class(['form-control', 'datetime-picker', 'datetimepicker-input', 'is-invalid' => $errors->has($name)])
            ->attribute('autocomplete', 'off')
            ->attribute('data-target', '#' . $uniqueId)
            ->attributeIf($required ?? false, 'required')
            ->attributeIf($disabled ?? false, 'disabled') }}
            
        <div class="input-group-append" data-target="#{{ $uniqueId }}" data-toggle="datetimepicker">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
    </div>
    
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>

@push('js')
<script>
    $(function () {
        $('#{{ $uniqueId }}').datetimepicker({
            locale: 'pt-br',
            // Alterado para incluir Horas e Minutos
            format: 'DD/MM/YYYY HH:mm', 
            allowInputToggle: true,
            // Adiciona botões úteis para facilitar a seleção
            buttons: {
                showToday: true,
                showClear: true,
                showClose: true
            },
            icons: {
                time: 'fas fa-clock',
                date: 'fas fa-calendar',
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash',
                close: 'fas fa-times'
            }
        });
    });
</script>
@endpush