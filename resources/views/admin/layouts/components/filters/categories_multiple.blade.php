<div class="form-group">
    {{ html()->label(__('Categorias'), 'q[categories]') }}
    {{ html()->multiselect('q[categories]', $all_categories ?? $categories, request()->input('q.categories'))
        ->id('categories')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('#categories').select2();
			});
        </script>
    @endpush
</div>
