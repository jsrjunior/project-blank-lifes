<div class="form-group mb-0">
    {{ html()->form('GET', $instance->route('claims'))->data('pjax', true)->open() }}
    <label for="stuff" class="fa fa-search input-search-icon" style="left: 30px;top: calc(50% - 0.7em);"></label>
    {{ html()->text('q[claim]', request()->input('q.claim'))->placeholder('Pessoa, nº acionamento, tipo (enter para pesquisar)')->class('form-control px-5') }}
    {{ html()->form()->close() }}
</div>

