<div class="form-group">
    {{ html()->label(__('Recorrência'), 'q[plans--interval_count][equals]') }}
    {{ html()->text('q[plans--interval_count][equals]', request()->input('q.plans--interval_count.equals'))->class('form-control mask-integer') }}
</div>
