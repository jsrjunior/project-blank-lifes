<div class="form-group">
    {{ html()->label(__('ID da Pessoa'), 'q[person_id][contains]') }}
    {{ html()->text('q[person_id][contains]', request()->input('q.person_id.contains'))->class('form-control') }}
</div>
