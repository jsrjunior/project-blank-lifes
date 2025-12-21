<div class="form-group">
    {{ html()->label(__('Ciclo do contrato'), 'q[cycle]') }}
    {{ html()->input('number','q[cycle]', request()->input('q.cycle'))->placeholder('Ciclo')->class('form-control')}}
</div>
