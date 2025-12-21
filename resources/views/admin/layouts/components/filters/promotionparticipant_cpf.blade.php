<div class="form-group">
    {{ html()->label(__('CPF'), 'q[cpf][contains]') }}
    {{ html()->text('q[cpf][contains]', request()->input('q.cpf.contains'))->class('form-control') }}
</div>
