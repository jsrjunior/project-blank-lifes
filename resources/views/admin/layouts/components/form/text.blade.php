<div class="form-group">
    @if(!(isset($label) && $label === false))
        {{ html()->label($label ?? modelAttribute($type, $name), $name)
            ->addClass($label_class ?? null)
        }}
    @endif
    {{
        html()->p($value)->attribute('style', 'padding: 8px 16px;')
    }}
</div>
