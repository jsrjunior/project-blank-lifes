<div class="form-group">
    {{ html()->label(__('Tipo de recorrência'), 'q[plans--interval][equals]') }}
    {{ html()->select('q[plans--interval][equals]', \App\Models\Plan::intervalOptions(), request()->input('q.plans--interval.equals'))->placeholder('')->class('form-control') }}
</div>
