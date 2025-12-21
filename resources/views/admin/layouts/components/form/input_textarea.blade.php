<div class="form-group {{ isset($required) && $required ? 'required' : '' }} {{ $class ?? '' }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    {{ html()->textarea($name, $value ?? null)->class(['form-control', 'is-invalid' => $errors->has($name)])->attribute('rows', $rows ?? 5)->attributeIf($required ?? false, 'required')->attributeIf($limit ?? false, 'maxlength="' . ($limit ?? false) . '"')->attributeIf($disabled ?? false, 'disabled') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
    @if ($subtext ?? false)
        <small>{{$subtext}}</small><br/>
    @endif
    @if ($limit ?? false)
        <small id="limit-value-{{ $name }}">{{ isset($value) ? strlen($value) : 0 }}/{{ $limit }} caracteres</small>
    @endif
    @if ($count ?? false)
        <small id="count-value-{{ $name }}">Contagem de caracteres: {{ isset($value) ? strlen($value) : 0 }}</small>
    @endif
</div>

@push('scripts')
    <script>
        function maxLength(el) {
            let max = el.attributes.maxLength.value;

            el.onkeyup = function() {
                if (max) {
                    $('#limit-value-{{ $name }}').html(`${this.value.length}/${(max)} caracteres`);
                }
            };
        }

        function removeAccents(el) {
            el.onkeyup = function() {
                $(this).val(this.value.normalize("NFD").replace(/[\u0300-\u036f]/g, ""));
            };
        }

        function countCharacters(el) {
            el.onkeyup = function() {
                $('#count-value-{{ $name }}').html(`Contagem de caracteres: ${this.value.length}`);
            };
        }

        $(function() {
            @if ($limit ?? false)
                maxLength(document.getElementById("{{ $name }}"));
            @endif

            @if ($removeAccents ?? false)
                removeAccents(document.getElementById("{{ $name }}"));
            @endif

            @if ($count ?? false)
                countCharacters(document.getElementById("{{ $name }}"));
            @endif
        });
    </script>
@endpush
