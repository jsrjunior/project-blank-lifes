@php($c_types = $types->toArray())
@php(asort($c_types))

<div class="form-group">
    {{ html()->label(__('Tipo de assinante'), 'q[type_customer]') }}
    {{ html()->select('q[type_customer]', $c_types, request()->input('q.type_customer'))->placeholder('')->class('form-control') }}
</div>
