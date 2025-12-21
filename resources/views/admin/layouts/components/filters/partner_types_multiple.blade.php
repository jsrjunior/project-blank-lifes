@php($a_partner = $partner_types->toArray())
<div class="form-group">
    {{ html()->label(isset($label) ? $label : __('Tipo de parceiro'), isset($id) ? 'q['.$id.']' : 'q[partner_types]') }}
    {{ html()->multiselect(isset($id) ? 'q['.$id.']' : 'q[partner_types]', $a_partner, request()->input(isset($id) ? 'q.'.$id : 'q.partner_types'))
        ->id('partner_types')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#partner_types').select2();
			});
        </script>
    @endpush
</div>