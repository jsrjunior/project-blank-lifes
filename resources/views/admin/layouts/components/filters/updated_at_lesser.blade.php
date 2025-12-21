<div class="form-group">
    {{ html()->label(__('Data de Atualização final'), 'q[updated_at][lesser]') }}
    <div class="input-group">
        {{ html()->text('q[updated_at][lesser]', request()->input('q.updated_at.lesser'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
    </div>
</div>
