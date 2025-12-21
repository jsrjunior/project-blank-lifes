<div class="form-group">
    {{ html()->label(__('Bills Inicial'), 'q[ranger_bills][begin]') }}
    <div class="input-group">
        {{ html()->text('q[ranger_bills][begin]', request()->input('q.ranger_bills.begin'))->attribute('autocomplete', 'off')->placeholder('')->class(['form-control', 'date-picker']) }}
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
    </div>
</div>