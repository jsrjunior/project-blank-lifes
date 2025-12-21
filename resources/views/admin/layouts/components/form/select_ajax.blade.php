<div class="form-group {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label(modelAttribute($type, $label_key ?? $name), $name) }}<br/>
    {{ html()->select($name, $options, isset($value) ? $value : null)
        ->id($id ?? $name)
        ->class(['form-control', 'is-invalid' => $errors->has($id ?? $name)])
        ->attributeIf($required ?? false, 'required') }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}

    @push('scripts')
        <script>
            $(function() {
				$('#{{ $id ?? $name }}').select2({
					@if($dropdownParent ?? false)
					dropdownParent: $("#{{$dropdownParent}}"),
					@endif
					placeholder: "Selecione uma opção",
					allowClear: true,
					ajax: {
						url: '{!! $url !!}',
						dataType: 'json',
						delay: 250,
						data: function (params) {
							return {
								q: params.term,
								page: params.page
							};
						},
						processResults: function (data, params) {
							params.page = params.page || 1;
							return {
								results: data.data,
								pagination: {
									more: data.hasMorePages
								}
							};
						},
						cache: true
					}
				});

				var span = '';
				var selectElement = document.getElementById('{{ $id ?? $name }}');
				var nextSibling = selectElement.nextElementSibling;
				while (nextSibling) {
					if (nextSibling.tagName === 'SPAN') {
						span = nextSibling;
						nextSibling.classList.add('w-100');
						break;
					}
					nextSibling = nextSibling.nextElementSibling;
				}

				$('#{{ $id ?? $name }}').on('select2:select', function (e) {
					var data = e.params.data;
					var spanFilho = span.querySelector('span');
					var spanNeto = spanFilho.querySelector('span');
					var spanBisneto = spanNeto.querySelector('span');
					spanBisneto.textContent = data.text;
				});

				@if(!isset($value))
					$('#{{ $id ?? $name }}').val(null).trigger('change');
				@else
					$('#{{ $id ?? $name }}').val({{$value}}).trigger('change.select2');
				@endif
            });
        </script>
    @endpush

    <style>
        .select2-container .select2-selection--single
        {
			font-size: 16px;
			min-height: 41px !important;
			line-height: 1.5 !important;
			padding: 8px 16px !important;
			border: 0 !important;
			color: var(--gray-700) !important;
            background-color: var(--gray-100) !important;
        }
    </style>
</div>
