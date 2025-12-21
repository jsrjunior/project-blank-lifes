@php($a_templates = $templates->toArray())
@php(asort($a_templates))
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Template'), isset($id) ? 'q['.$id.']' : 'q[template]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[template]', $a_templates, request()->input(isset($id) ? 'q.'.$id : 'q.template'))
        ->id('template')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#template').select2();
			});
        </script>
    @endpush
</div>
