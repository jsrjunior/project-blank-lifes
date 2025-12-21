<div class="form-group">
    {{ html()->label(__('Data de inclusão final'), 'q[subscriptions][included_lesser]') }}
    <div class="input-group">
        {{ html()->text('q[subscriptions][included_lesser]', request()->input('q.subscriptions.included_lesser'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
    </div>
</div>