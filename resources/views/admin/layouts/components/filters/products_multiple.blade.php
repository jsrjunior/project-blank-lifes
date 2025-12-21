<div class="form-group">
    {{ html()->label(__($title ?? 'Produtos'), $id ?? 'q[products]') }}
    {{ html()->multiselect($id ?? 'q[products]', $products, request()->input($name ?? 'q.products'))
        ->id($id_select ?? 'products')
        ->class('form-control') }}
    @push('scripts')
        <script>
			$(function() {
				$('{{ isset($id_select) ? '#'.$id_select :  '#products' }}').select2();
			});
        </script>
    @endpush
</div>
