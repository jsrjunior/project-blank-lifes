<div class="form-group">
    {{ html()->label(__('Coberturas'), 'q[plans]') }}
    {{ html()->multiselect('q[plans]', $all_plans ?? $plans, request()->input('q.plans'))
        ->id('plans')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#plans').select2();
			});
        </script>
    @endpush
</div>
