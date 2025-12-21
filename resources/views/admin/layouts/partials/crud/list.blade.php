<div class="col-lg-12">

    <div class="container-fluid d-block d-sm-flex justify-content-center py-4 px-0 card-filter-crud-box">
        <div class="col-12 text-center text-sm-right">

            {{-- Aqui a nova seção para inserção de conteúdo HTML pelo usuário --}}
            @hasSection('buttons')
                @yield('buttons')
            @endif

            @hasSection('filters')
                <a role="button" class="btn btn-light-blue btn-grid-crud" href="#card-filter-crud" data-toggle="collapse">
                    <i class="far fa-filter"></i> {{ __('Filtros') }}
                </a>
            @endif

            @if ($instance->hasRoute('import'))
                @can('import', $instance)
                    <div class="btn-group">
                        <a href="{{ $instance->route('import') }}" data-pjax class="btn btn-primary btn-grid-crud">
                            <i class="fa fa-upload" aria-hidden="true"></i> {{ modelAction($type, 'import') }}
                        </a>
                    </div>
                @endcan
            @endif

            @if ($instance->hasRoute('export'))
                @can('export', $instance)
                    <a href="{{ $instance->route('export') }}?{{ http_build_query(request()->only('q', 'order')) }}" class="btn btn-dark mr-1 btn-grid-crud">
                        {{ modelAction($type, 'export') }}
                    </a>
                @endcan
            @endif

            @if ($instance->hasRoute('create'))
                <a href="{{ $instance->route('create') }}" data-pjax class="btn btn-primary ml-1 btn-grid-crud">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ modelAction($type, 'create') }}
                </a>
            @endcan
        </div>
    </div>
<div class="table-responsive">
    <table class="table table-hover" id="table-list">
        <thead>
        <tr>
            @foreach ($instance->getAdminColumns() as $column)
                <th {!! $instance->getAdminColumnAttributes($loop->index, $column) !!}>
                    @if(in_array($column, $instance->getOrderColumns()))
                        @component('admin.layouts.components.link_order')
                            @slot('column', $column)
                            {{ modelAttribute($type, $column) }}
                        @endcomponent
                    @else
                        {{ modelAttribute($type, $column) }}
                    @endif
                </th>
            @endforeach
            <th class="shrink"></th>
        </tr>
        </thead>
        <tbody>
        @forelse ($resources as $resource)
            <tr {!! $instance->getAdminRowAttributes($loop->index) !!}
                @if(!empty($resource->history[0]))
                    class="history clickable-row" style="cursor: pointer;"  onclick="toggleDetails({{$resource->id}})"
                    id="resource_{{ $resource->id }}"
                    @php
                    echo ':key="'.$resource->id.'"';
                    @endphp
                @endif
            >


                @foreach ($resource->getAdminColumns() as $column)
                    <td {!! $resource->getAdminColumnAttributes($loop->index, $column) !!}>
                        {!! $resource->getAdminColumn($column) !!}
                    </td>
                @endforeach

                <td class="shrink text-right" style="display: none">

                    {!! $resource->getAdminActions() !!}


                    @if($resource->getAdminDropdownActions())
                        <div class="d-inline">
                            <a href="#" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                {!! $resource->getAdminDropdownActions() !!}
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            @if(isset($resource->contractInteractionStatus->name) && $resource->contractInteractionStatus->name != 'finished')
                <tr class="hidden-content_{{ $resource->id }}" style="display: none;" id="form_{{ $resource->id }}">
                    <td colspan="100%" class="form-history-{{$resource->id}}">


                    </td>
                </tr>


            @endif


            @if(!empty($resource->history[0]))
                @foreach ($resource->history as $history)
                    <tr class="hidden-content_{{ $resource->id }} custom-border">
                        <td colspan="10%" style="text-align: center;  padding: 21px;">
                            <div class="hidden-content_{{ $resource->id }}" style="width: 100%; height: 100%; color: #621587; font-size: 13.98px; font-family: Inter; font-weight: 500; line-height: 20.96px; word-wrap: break-word; display: none;">{{$history->id}}</div>
                        </td>
                        <td colspan="90%">
                            <div class="hidden-content_{{ $resource->id }}" style="width: 100%; color: #621587; font-size: 13.98px; font-family: Inter; font-weight: 500; line-height: 20.96px; word-wrap: break-word; display: none;">{{$history->user->name}} em {{formatarData($history->created_at)}} | Prazo : {{formatarData($history->deadline)}}</div>
                            <div style="width: 100%; color: #3F4254; font-size: 13.98px; font-family: Inter; font-weight: 500; line-height: 20.96px; word-wrap: break-word">{{$history->contractInteractionSubStatus->description}}</div>
                            <div class="hidden-content_{{ $resource->id }}"class="hidden-content_{{ $resource->id }}" style="width: 100%; color: #7E8299; font-size: 13.98px; font-family: Inter; font-weight: 500; line-height: 20.96px; word-wrap: break-word; display: none;">{{isset($history->contractInteractionChannel) ? $history->contractInteractionChannel->description : ''}}: {{$history->description}} <br/>{{isset($history->contractInteractionNotPay->description) ? $history->contractInteractionNotPay->description : ''}}</div>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
</div>
</div>

<style>
   .history:hover td {
      /* Define a cor de fundo para as células da linha em destaque */
      background-color: #c8d7eb;
    }

     /* Estilo para a borda lateral */
     .custom-border {
        border-left: 3px solid #621587;
        border-radius: 6px;
        display: none;
        flex-shrink: 0;

    }

       /* Estilos para as células de conteúdo oculto */
    .hidden-content-cell {
      text-align: right;
      color: #3F4254;
      font-size: 15px;
      font-family: Roboto;
      font-weight: 500;
      word-wrap: break-word;
      display: none;
      text-align: center;
    }

    /* Estilos para o conteúdo oculto dentro das células */
    .hidden-content {
      width: 100%;
      height: 100%;
    }


</style>

<script>
    // Função para carregar apenas a div desejada do iframe
    function loadIframeDiv() {
        // Obter o elemento do iframe pelo ID ou por outro seletor, se aplicável
        const iframeElement = document.getElementById('contractInteractionFrame');

        // Verificar se o iframe foi carregado
        iframeElement.addEventListener('load', function() {
            // Acessar o documento dentro do iframe
            const iframeDocument = iframeElement.contentDocument || iframeElement.contentWindow.document;

            // Selecionar a div desejada dentro do iframe
            const divElement = iframeDocument.querySelector('.div-to-load');

            // Verificar se a div foi encontrada e fazer o que você precisa
            if (divElement) {
                // Aqui você pode manipular a div desejada do iframe como quiser
                console.log(divElement);
            }
        });
    }

    // Chamando a função de carregamento após o carregamento da página
    window.addEventListener('DOMContentLoaded', loadIframeDiv);
</script>













