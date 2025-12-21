@section('title', title(modelAction($type, 'label')))

@section('content')

    <div class="row">
        @hasSection('filters')
            <div class="col-lg-12">
                @component('admin.layouts.components.card_filter')
                    {{ html()->form('GET', $instance->route('index'))->data('pjax', true)->open() }}
                    @yield('filters')
                    @include('admin.layouts.components.filters.buttons')
                    {{ html()->form()->close() }}
                @endcomponent
            </div>
        @endif
    </div>

    @component('admin.layouts.components.header')
        @slot('title', modelAction($type, 'label'))
        @slot('aside')
        @slot('not_display_subtitle',true)
        @endslot
        @yield('header')
    @endcomponent

    <div class="row">

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

                    @if ($instance->hasRoute('download'))
                        @can('download', $instance)
                            <a role="button" data-url="{{ $instance->route('download') }}?{{ http_build_query(request()->only('q', 'order')) }}" data-pjax class="btn btn-primary btn-grid-crud btn-download">
                                <i class="fa fa-download" aria-hidden="true"></i> Download
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

            @component('admin.layouts.components.card_clean')
                @slot('title', modelAction($type, 'index'))
                @slot('class', 'mb-4')

                @slot('actions')
                    @if(isset($totalAmount) && $totalAmount > 0)
                        <span class="text-muted">{{ __('Valor total: ') . moneyFormat($totalAmount) }}</span>
                    @endif

                    @php($additionalActionsView = 'admin.'.$instance->getTable().'.partials.additional_actions')
                    @includeWhen(View::exists($additionalActionsView), $additionalActionsView)
                @endslot

                <div class="table-responsive">
                    <table class="table table-hover">
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
                                <tr {!! $instance->getAdminRowAttributes($loop->index, $resource) !!}>
                                   @foreach ($resource->getAdminColumns() as $key => $column)
                                        <td {!! $resource->getAdminColumnAttributes($loop->index, $column) !!}>
                                            @if ($column === 'new_data')
                                                @if ($resource->approvalable_type === "App\Models\DependentFollowup" && !empty($resource->new_data))
                                                    {{ $resource->new_data['rule_obs'] ?? '—' }}
                                                @else
                                                    —
                                                @endif

                                            @elseif ($column === 'contract_id')
                                                @if (!empty($resource->new_data['contract_id']))
                                                    <a href="/contract/{{ $resource->new_data['contract_id'] }}/edit"
                                                        class="text-blue"
                                                        >
                                                        {{ $resource->new_data['contract_id'] }}
                                                    </a>
                                                @else
                                                    —
                                                @endif
                        
                                            @else
                                                {!! $resource->getAdminColumn($column) !!}
                                            @endif
                                        </td>
                                    @endforeach

                                    
                                    <td class="shrink text-right">

                                        {!! $resource->getAdminActions() !!}

                                        @if(!method_exists($resource, 'withDefaultActions') || (method_exists($resource, 'withDefaultActions') && $resource->withDefaultActions()))
                                            @can('view', $resource)
                                                <a href="{{ $resource->route('show') }}" data-pjax data-toggle="tooltip" title="Visualizar" class="btn btn-primary-green btn-sm"><i class="fa fa-eye"></i></a>
                                            @endcan
                                            
                                            @if (! $resource instanceof \App\Models\Approval)
                                                @can('update', $resource)
                                                    <a href="{{ $resource->route('edit') }}" data-pjax data-toggle="tooltip" title="Editar" class="btn btn-previous btn-sm"><i class="fa fa-pen"></i></a>
                                                @endcan
                                            @endif

                                            @if ($instance->hasRoute('delete'))
                                                @can('delete', $resource)
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm btn-dlt"
                                                        data-url="{{ $resource->route('delete') }}"
                                                        title="Excluir"
                                                    >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                            @endif

                                        @endif

                                        @if($resource->getAdminDropdownActions())
                                            <div class="d-inline">
                                                <a href="#" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {!! $resource->getAdminDropdownActions() !!}
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($instance->getAdminColumns()) + 1 }}">
                                        {{ trans('pagination.no_records') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            @endcomponent

            @component('admin.layouts.partials.paginator')
                @slot('paginator', $resources)
            @endcomponent

            @yield('after-table')
        </div>
    </div>
    @if (isset($resource) && get_class($resource) === "App\Models\Reports\SubscriptionRenewal")
        @include('admin.subscriptions.partials.modal_consent_historic')
    @endif
@stop

@push('js')
<script>
    document.addEventListener('click', function (event) {
        const btn = event.target.closest('.btn-dlt');
        if (!btn) return;
    
        // 🔒 bloqueia COMPLETAMENTE a propagação
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    
        const url = btn.dataset.url;
        if (!url) return;
    
        Swal.fire({
            title: 'Atenção',
            html: '{{ modelAction($type, 'confirmation.delete') }}',
            imageUrl: '/img/admin/alerts/modal_warning.png',
            imageClass: 'img-fluid',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#dc3545',
            allowOutsideClick: false,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("tr.clickable-row").forEach(function (row) {
            row.addEventListener("click", function (e) {
                if (e.target.closest("a, button, form, input[type=radio], input[type=checkbox], input[type=text]")) {
                    return;
                }

                let pjaxLink = row.querySelector("a[data-pjax]");
                if (pjaxLink) {
                    pjaxLink.click();
                } else {
                    window.location = row.dataset.href;
                }
            });
        });
    });

</script>
@endpush
