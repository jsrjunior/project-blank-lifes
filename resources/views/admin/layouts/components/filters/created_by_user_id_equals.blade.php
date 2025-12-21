<div class="form-group">
    {{ html()->label(__('Usuário que criou'), 'q[created_by_user_id][equals]') }}
    {{ html()->select('q[created_by_user_id][equals]', $users, request()->input('q.created_by_user_id.equals'))->placeholder(null)->class('form-control') }}
</div>
