@php
    $acceptToReceiveCommunicationsByPhone = \App\Services\CustomerService::getPromotionPreference($customer_id ?? $id ?? null, 'phone');
    $acceptToReceiveCommunicationsByWhatsapp = \App\Services\CustomerService::getPromotionPreference($customer_id ?? $id ?? null, 'whatsapp');
    $type_documento_id = \App\Models\ContractDocumentType::where('name', 'Contrato')->value('id');
    $isContract = isset($status_contract);
    $contractId = $id;
    $documentRoute = 'web.admin.contract_documents.downloadContract';
    $hideContractDownload = false;
    
    if ($contractId) {
        $hasSubCategory18 = \App\Models\Subscription::where('contract_id', $contractId)
            ->whereHas('plan', function ($query) {
                $query->where('plans.plan_sub_categories_id', 18);
            })
            ->exists();

        $hideContractDownload = $hasSubCategory18;
    }

    if(!$isContract){
        $contractId = \App\Models\Contract::where('customer_id', '=', $id)->first()?->id;
        $documentRoute = 'web.admin.contract_documents.downloadLastContractByCustomer';
    }
    
    $documento = \App\Models\ContractDocument::where('contract_id', $contractId)->where('contract_document_type_id', $type_documento_id)->first();
    if($documento)
        $documentRoute = route($documentRoute, $isContract ? $documento?->id : $id);

@endphp

<div class="card">
    @if (isset($customer_id))
        <div class="card-header card-header-rounded d-none d-sm-block bg-blue p-3">
            <div class="row d-flex">
                <div class="col-12">
                    <a href="{{route('web.admin.customers.account-view', $customer_id)}}" class="text-decoration-none">
                        <h3 class="text-white text-left mb-0 pl-2">
                            <img src="{{$customer_avatar}}" class="avatar img-fluid mr-2" alt="{{ $customer_name }}">
                            {{ $customer_name }}
                            <button class="btn border-white text-white py-2 ml-5">
                                Ir para conta
                            </button>
                        </h3>
                    </a>
                </div>
            </div>
        </div>
    @endif
    <div class="card-body top-account-contract-card">
        <div class="row d-flex">
            <div class="col-12 col-sm-7">
                <div class="container row justify-content-start align-items-start">
                    <h2 class="text-uppercase mb-0 pr-0 pr-sm-3 text-gray-800">{{$name}}</h2>
                    @if (isset($status_account))
                        {{buildStatusMainBadgeBlade($status_name, $status_color, 'Status da conta')}}
                        @foreach ($tags as $tag)
                            {{-- @if($tag['name'] == 'RA' || $tag['name'] == 'RA Reincidente') --}}
                                {{buildStatusBadgeBlade($tag['name'], $tag['color'], $tag['description'])}}
                            {{-- @endif --}}
                        @endforeach
                    @endif

                    @if (!empty($indication_tag) && $indication_tag)
                        {{buildStatusMainBadgeBlade("+10 Indicações", '#F3CC', 'Status da conta')}}
                    @endif

                    @if (!empty($blacklist_tag) && $blacklist_tag)
                        {{buildStatusMainBadgeBlade("Blacklist", '#000', 'Contato está na blacklist')}}
                    @endif

                    @if (!empty($lead_account_indicator) && $lead_account_indicator)
                        {{buildStatusMainBadgeBlade("Lead Indicador", '#b4d400', 'Conta de lead indicador')}}
                    @endif
                </div>

                @if (isset($status_contract))
                    <div class="container row align-items-start mt-3 mb-3 mb-sm-5">
                        {{buildStatusMainBadgeBlade($status_name, $status_color, 'Status da cobertura principal')}}
                        @foreach ($tags as $tag)
                            {{buildStatusBadgeBlade($tag['name'], $tag['color'], $tag['description'])}}
                        @endforeach
                    </div>
                @endif

                @if(isset($documento) && !$hideContractDownload)
                    <div class="col-12 col-sm-6 text-gray-600 p-0"><a href="{{$documentRoute}}?token={{\App\Library\Utils\Hash::resolve($documento)}}" target="_blank">
                        <span class="top-account-contract-spam-item"><small>
                        <i class="fa fa-download"></i></small></span> Download Contrato</a>
                    </div>
                @endif

                <div class="row d-flex align-items-center mt-3">
                    @if(isset($id) && isset($status_account))
                        <div class="col-12 col-sm-6 text-gray-600">
                            <span class="top-account-contract-spam-item"><small><i class="fa fa-user"></i></small> ID:</span> {{$id}}
                        </div>
                    @endif

                    @if(isset($document))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-file-user"></i></small> CPF:</span> {{$document}}</div>
                    @endif

                    @if(isset($cnpj))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-file-user"></i></small> CNPJ:</span> {{$cnpj}}</div>
                    @endif

                    @if(isset($email))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-at"></i></small></span> {{$email}}</div>
                    @endif

                    @if (isset($address))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-location"></i></small> Região:</span> {{$address}}</div>
                    @endif

                    @if(isset($phone))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-phone"></i></small></span> {{$phone}}</div>
                    @endif

                    @if(isset($created_at))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-calendar"></i></small> Data de criação:</span> {{$created_at}}</div>
                    @endif

                    @if(isset($fidelity_date))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-calendar"></i></small> Data de fidelização:</span> {{$fidelity_date}}</div>
                    @endif

                    @if(isset($start_at))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-calendar"></i></small> Data de início de vigência:</span> {{$start_at}}</div>
                    @endif

                    @if(isset($end_waiting_period_at))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item"><small><i class="fa fa-calendar"></i></small> Data de fim de carência:</span> {{$end_waiting_period_at}}</div>
                    @endif

                    @if(isset($canceled_at))
                        <div class="col-12 col-sm-6 text-gray-600"><span class="top-account-contract-spam-item text-danger"><small><i class="fa fa-calendar"></i></small> Data de cancelamento:</span> {{$canceled_at}}</div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-5 text-center text-sm-right mt-3 mt-sm-0">
                <span class="pr-3 pr-sm-3">
                    @include('admin.layouts.partials.actions.call-phone', ['acceptToReceiveCommunicationsByPhone' => $acceptToReceiveCommunicationsByPhone])
                </span>

                <span class="pr-3 pr-sm-3">
                    @include('admin.layouts.partials.actions.whatsapp', [
                        'acceptToReceiveCommunicationsByWhatsapp' => $acceptToReceiveCommunicationsByWhatsapp,
                        'module' => $module,
                        ])
                </span>

                <span>
                    @include('admin.layouts.partials.actions.action-button')
                </span>

                <!-- Modal de carregamento -->
                <div class="modal" id="sendingEmail" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content text-center p-4">
                            <div class="modal-header border-0 w-100 d-block">
                                <h4 class="modal-title">Enviando email</h4>
                            </div>
                            <div class="modal-body">
                                <div class="spinner-border text-primary mb-3" role="status">
                                    <span class="sr-only">Carregando...</span>
                                </div>
                                <p>Esse aviso será fechado automaticamente quando o envio for concluído</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-top py-1">
        @if (isset($navbar_action_options))
            <ul class="nav nav-pills mb-0 top-account-contract-pills contract" id="pills-tab" role="tablist">
                @foreach ( $navbar_action_options['items'] as $key => $navbar_action_option)
                    <li class="nav-item">
                        <a
                            class="nav-link {{($key === array_key_first($navbar_action_options['items'])) ? 'active' : ''}}"
                            {{($navbar_action_option['target']) ? 'id='.$navbar_action_option['target'] : ''}}
                            data-toggle="pill"
                            href="{{$navbar_action_option['link']}}"
                            role="tab"
                            {{($navbar_action_option['target']) ? 'aria-controls='.$navbar_action_option['target'] : ''}}
                            {{($key === array_key_first($navbar_action_options['items'])) ? 'aria-selected=true' : ''}}
                        >
                            {{$navbar_action_option['label']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
