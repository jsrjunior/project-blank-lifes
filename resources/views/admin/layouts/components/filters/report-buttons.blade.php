<div class="form-group mb-0">
    <a href="{{ url()->current() }}" data-pjax class="btn btn-link btn-grid-crud">Limpar filtros</a>
    {{ html()->submit('Filtrar')->class('btn btn-primary btn-grid-crud') }}
</div>