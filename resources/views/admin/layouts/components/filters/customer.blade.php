<div class="form-group mb-0">
    {{ html()->form('GET', $instance->route('account'))->data('pjax', true)->open() }}
    <label for="stuff" class="fa fa-search input-search-icon" style="left: 30px;top: calc(50% - 0.7em);"></label>
    {{ html()->text('q[customer]', request()->input('q.customer'))->placeholder('Id, nome, e-mail ou CPF (enter para pesquisar)')->class('form-control px-5') }}
    {{ html()->form()->close() }}
</div>
