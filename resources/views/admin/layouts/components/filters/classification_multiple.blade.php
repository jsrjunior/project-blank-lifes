@php($a_classification = $template_classifications->toArray())
@php(asort($a_classification))
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Classificação'), isset($id) ? 'q['.$id.']' : 'q[classification]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[classification]', $a_classification, request()->input(isset($id) ? 'q.'.$id : 'q.classification'))
        ->id('classification')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#classification').select2();
			});
        </script>
    @endpush
</div>
