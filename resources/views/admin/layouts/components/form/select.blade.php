@php($simple = $simple ?? true)
@php($options = isset($options) ? (is_array($options) ? $options : $options->toArray()) : [])
@php($options = $options instanceof \Illuminate\Support\Collection ? $options->toArray() : $options)

<div {{ isset($id_wrapper) ? 'id='.$id_wrapper : '' }} class="form-group {{ isset($required) && $required ? 'required' : '' }} {{ $class ?? '' }}"
@if(isset($style))
    style="{{ $style }}"
@endif
>
    {{ html()->label($label ?? modelAttribute($type, $name), $name)->attributes(['style' => 'white-space: nowrap;']) }}

    @if (isset($tooltip))
        @php($tooltip_class = $tooltip_class ?? 'fa fa-question-circle')
        {{ html()->span()->addClass($tooltip_class)->attribute('data-toggle', 'tooltip')->attribute('data-title', $tooltip) }}
    @endif

    <br/>

    {{ html()->select($name, $options ?? null, $value ?? null)->id($id ?? $name)->placeholder($placeholder ?? null)->disabled($disabled ?? false)->class(['form-control', 'is-invalid' => $errors->has($name)])->attributeIf($required ?? false, 'required')->attributeIf(isset($tabindex), 'tabindex', '-1')->attributeIf(
            isset($tabindex),
            'style',
            'background: #EEE;
          pointer-events: none;
          touch-action: none;
          margin-left: 5px;',
        )->attributeIf(isset($aria_disabled), 'aria-disabled') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}

    @if (!$simple)
        @push('scripts')
            <script>
                $(function() {
                    var $field = $('#{{ $name }}');
                    $field.select2({{ isset($tags) && $tags ? '{ tags: true }' : '' }});
                    $field.on('select2:close', function() {
                        $field.trigger('blur');
                    });
                });
            </script>
        @endpush
    @endif
</div>
