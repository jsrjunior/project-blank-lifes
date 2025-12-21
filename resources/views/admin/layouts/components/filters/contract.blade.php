<div class="form-group mb-0">
    {{ html()->form('GET', $instance->route('contract'))->data('pjax', true)->open() }}
    <label for="stuff" class="fa fa-search input-search-icon" style="left: 30px;top: calc(50% - 0.7em);"></label>
    {{ html()->text('q[contract]', request()->input('q.contract'))->placeholder('Titular, nº contrato ou nº protocolo (enter para pesquisar)')->class('form-control px-5') }}
    {{ html()->form()->close() }}
</div>

