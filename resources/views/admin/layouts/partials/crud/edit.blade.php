@section('title', title(modelAction($type, 'edit')))

@section('content')
    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        
        @slot('aside')
            <div class="btn-group">
                @if($instance->deleted_at)
                    @can('restore', $instance)
                        {{-- Formulário de Restauração --}}
                        {!! html()->form('PUT', $instance->route('restore'))->attributes([
                            'class' => 'd-inline',
                            'onsubmit' => "return confirm('" . modelAction($type, 'confirmation.restore') . "')"
                        ])->open() !!}
                            <button type="submit" class="btn btn-warning" data-toggle="tooltip" title="Restaurar">
                                {{ modelAction($type, 'restore') }}
                            </button>
                        {!! html()->form()->close() !!}
                    @endcan
                @else
                    @can('delete', $instance)
                        {{-- Formulário de Exclusão --}}
                        {!! html()->form('DELETE', $instance->route('delete'))->attributes([
                            'class' => 'd-inline',
                            'onsubmit' => "return confirm('" . modelAction($type, 'confirmation.delete') . "')"
                        ])->open() !!}
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Excluir">
                                {{ modelAction($type, 'delete') }}
                            </button>
                        {!! html()->form()->close() !!}
                    @endcan
                @endif
            </div>
        @endslot
        @yield('header')
    @endcomponent

    {{-- Inicializa o modelo (importante para preencher os campos automaticamente no yield form) --}}
    @php html()->model($instance); @endphp

    {!! html()->form('PUT', $instance->route('update'))
        ->id('form-update')
        ->acceptsFiles(true)
        ->data('validation', $instance->hasRoute('validation') ? $instance->route('validation') : '')
        ->open() !!}
        
        @yield('form')


    {!! html()->form()->close() !!}
    
    @php html()->endModel(); @endphp
@stop