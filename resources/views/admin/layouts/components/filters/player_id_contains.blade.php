<div class="form-group">
    {{ html()->label(__('Player ID'), 'q[player_id]') }}
    {{ html()->text('q[player_id]', request()->input('q.player_id'))->class('form-control') }}
</div>
