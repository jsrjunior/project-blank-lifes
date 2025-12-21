@php($a_person = $people->toArray())
@php(asort($a_person))
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Pessoa'), isset($id) ? 'q['.$id.']' : 'q[person]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[person]', $a_person, request()->input(isset($id) ? 'q.'.$id : 'q.person'))
        ->id('person')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#person').select2();
			});
        </script>
    @endpush
</div>
