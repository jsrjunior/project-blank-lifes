@section('title', title(modelAction($type, 'label')))

@section('content')

    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        {{-- @slot('breadcrumbs', app('breadcrumbs'))--}}
        @yield('header')
    @endcomponent

    {{ html()->form('PUT', $instance->route('import'))->acceptsFiles(true)->data('pjax', true)->data('validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')->open() }}
        @yield('form')
    {{ html()->form()->close() }}

@stop
