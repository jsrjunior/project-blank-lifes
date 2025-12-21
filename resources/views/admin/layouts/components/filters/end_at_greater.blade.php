<div class="form-group">
    {{ html()->label(__('Data de Termino(inicial)'), 'q[end_at][greater]') }}
    <div class="input-group">
        {{ html()->text('q[end_at][greater]', request()->input('q.end_at.greater'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
    </div>
</div>
