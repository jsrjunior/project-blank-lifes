@php(asort($import_types))

<div class="form-group">
    {{ html()->label(__($label ?? 'Tipo'), 'q[import_type_id][equals]') }}
    {{ html()->select('q[import_type_id][equals]', $import_types, request()->input('q.import_type_id.equals'))->placeholder('')->class('form-control') }}
</div>
