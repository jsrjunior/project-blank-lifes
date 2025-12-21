<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $name), $name) }}
    @if(isset($tooltip))
        @php($tooltip_class = $tooltip_class ?? 'fa fa-question-circle')
        @php($tooltip_class = $tooltip_class ?? 'fa fa-question-circle')
        {{
            html()->span()
            ->addClass($tooltip_class)
            ->attribute('data-toggle', 'tooltip')
            ->attribute('data-title', $tooltip)
        }}
    @endif
    {{ html()->input('password', $name)->class(['form-control', 'is-invalid' => $errors->has($name)])->required(isset($required) ? $required : false) }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>
