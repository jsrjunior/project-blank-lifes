@php($a_model_type = $models->toArray())
@php(asort($a_model_type))
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Modelo'), isset($id) ? 'q['.$id.']' : 'q[classification]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[model_type]', $a_model_type, request()->input(isset($id) ? 'q.'.$id : 'q.model_type'))
        ->id('model_type')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#model_type').select2();
			});
        </script>
    @endpush
</div>
