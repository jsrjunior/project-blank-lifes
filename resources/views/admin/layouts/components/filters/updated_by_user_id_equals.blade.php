<div class="form-group">
    {{ html()->label(__('Usuário que editou'), 'q[updated_by_user_id][equals]') }}
    {{ html()->select('q[updated_by_user_id][equals]', $users, request()->input('q.updated_by_user_id.equals'))->placeholder(null)->class('form-control') }}
</div>
