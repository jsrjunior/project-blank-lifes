<div class="form-group">
    {{ html()->label(__('Nome Fantasia'), 'q[fantasy_name][contains]') }}
    {{ html()->text('q[fantasy_name][contains]', request()->input('q.fantasy_name.contains'))->class('form-control') }}
</div>
