@php(asort($agencies))

<div class="form-group">
    {{ html()->label(__($label ?? 'Agência'), 'q[agency_id][equals]') }}
    {{ html()->select('q[agency_id][equals]', $agencies, request()->input('q.agency_id.equals'))->placeholder('')->class('form-control') }}
</div>
