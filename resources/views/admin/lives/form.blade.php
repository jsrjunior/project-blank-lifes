@section('form')
@php(html()->model($instance))

<div class="row">
    <div class="col-12">
        @component('admin.layouts.components.card')
        @slot('title', __('Dados Pessoais'))
        
        {{-- DADOS GERAIS (Aqui mantemos os componentes pois são campos fixos) --}}
        <div class="row">
            <div class="col-md-8">
                @component('admin.layouts.components.form.input_text')
                    @slot('name', 'name')
                    @slot('label', 'Nome Completo')
                    @slot('required', true)
                @endcomponent
            </div>
            <div class="col-md-4">
                @component('admin.layouts.components.form.input_date')
                    @slot('name', 'birth_date')
                    @slot('label', 'Data de Nascimento')
                    @slot('value', $instance->birth_date ? $instance->birth_date->format('d/m/Y') : null)
                @endcomponent
            </div>
        </div>

        {{-- SEÇÃO: DOCUMENTOS --}}
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">{{ __('Documentos') }}</h5>
            <button type="button" class="btn btn-outline-success btn-sm btn-add-dynamic" data-target="document">
                <i class="fa fa-plus"></i> Adicionar Documento
            </button>
        </div>

        <div id="documents-wrapper">
            @php($documents = old('documents', $instance->documents ?? []))
            @foreach($documents as $index => $doc)
            <div class="row document-row mb-2 align-items-end">
                @if(isset($doc['id'])) <input type="hidden" name="documents[{{$index}}][id]" value="{{$doc['id']}}"> @endif
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">Tipo de Documento</label>
                        <select name="documents[{{$index}}][document_type_id]" class="form-control form-control-sm">
                            @foreach($documentTypes as $k => $v)
                                <option value="{{$k}}" {{ ($doc['document_type_id'] ?? '') == $k ? 'selected' : '' }}>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">Número do Documento</label>
                        <input type="text" name="documents[{{$index}}][number]" value="{{$doc['number'] ?? ''}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- SEÇÃO: TELEFONES --}}
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">{{ __('Telefones') }}</h5>
            <button type="button" class="btn btn-outline-success btn-sm btn-add-dynamic" data-target="phone">
                <i class="fa fa-plus"></i> Adicionar Telefone
            </button>
        </div>
        
        <div id="phones-wrapper">
            @php($phones = old('phones', $instance->phones ?? []))
            @foreach($phones as $index => $phone)
            <div class="row phone-row mb-2 align-items-end">
                @if(isset($phone['id'])) <input type="hidden" name="phones[{{$index}}][id]" value="{{$phone['id']}}"> @endif
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">Tipo</label>
                        <select name="phones[{{$index}}][type]" class="form-control form-control-sm">
                            @foreach($phoneTypes as $k => $v)
                                <option value="{{$k}}" {{ ($phone['type'] ?? '') == $k ? 'selected' : '' }}>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">DDD</label>
                        <input type="number" name="phones[{{$index}}][ddd]" value="{{$phone['ddd'] ?? ''}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">Número</label>
                        <input type="number" name="phones[{{$index}}][number]" value="{{$phone['number'] ?? ''}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="phones[{{$index}}][is_primary]" value="1" class="custom-control-input" id="phone_pri_{{$index}}" {{ ($phone['is_primary'] ?? false) ? 'checked' : '' }}>
                        <label class="custom-control-label small" for="phone_pri_{{$index}}">Principal</label>
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- SEÇÃO: EMAILS --}}
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">{{ __('Emails') }}</h5>
            <button type="button" class="btn btn-outline-success btn-sm btn-add-dynamic" data-target="email">
                <i class="fa fa-plus"></i> Adicionar Email
            </button>
        </div>

        <div id="emails-wrapper">
            @php($emails = old('emails', $instance->emails ?? []))
            @foreach($emails as $index => $email)
            <div class="row email-row mb-2 align-items-end">
                @if(isset($email['id'])) <input type="hidden" name="emails[{{$index}}][id]" value="{{$email['id']}}"> @endif
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">Tipo</label>
                        <select name="emails[{{$index}}][email_type_id]" class="form-control form-control-sm">
                            @foreach($emailTypes as $k => $v)
                                <option value="{{$k}}" {{ ($email['email_type_id'] ?? '') == $k ? 'selected' : '' }}>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="small font-weight-bold mb-1">E-mail</label>
                        <input type="email" name="emails[{{$index}}][email]" value="{{$email['email'] ?? ''}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-center">
                    <div class="custom-control custom-checkbox mr-3">
                        <input type="checkbox" name="emails[{{$index}}][is_primary]" value="1" class="custom-control-input" id="email_pri_{{$index}}" {{ ($email['is_primary'] ?? false) ? 'checked' : '' }}>
                        <label class="custom-control-label small" for="email_pri_{{$index}}">Principal</label>
                    </div>
                    <span class="badge badge-{{ ($email['is_verified'] ?? false) ? 'success' : 'secondary' }}">
                        {{ ($email['is_verified'] ?? false) ? 'Verificado' : 'Pendente' }}
                    </span>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- SEÇÃO: ENDEREÇOS --}}
        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">{{ __('Endereços') }}</h5>
            <button type="button" class="btn btn-outline-success btn-sm btn-add-dynamic" data-target="address">
                <i class="fa fa-plus"></i> Adicionar Endereço
            </button>
        </div>

        <div id="addresses-wrapper">
            @php($addresses = old('addresses', $instance->addresses ?? []))
            @foreach($addresses as $index => $address)
            <div class="address-row border p-3 mb-3 rounded bg-light shadow-sm">
                @if(isset($address['id'])) <input type="hidden" name="addresses[{{$index}}][id]" value="{{$address['id']}}"> @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label class="small font-weight-bold mb-1">Tipo</label>
                            <select name="addresses[{{$index}}][address_type_id]" class="form-control form-control-sm">
                                @foreach($addressTypes as $k => $v)
                                    <option value="{{$k}}" {{ ($address['address_type_id'] ?? '') == $k ? 'selected' : '' }}>{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label class="small font-weight-bold mb-1">CEP</label>
                            <input type="text" name="addresses[{{$index}}][zipcode]" value="{{$address['zipcode'] ?? ''}}" class="form-control form-control-sm zip-input">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="small font-weight-bold mb-1">Rua/Logradouro</label>
                            <input type="text" name="addresses[{{$index}}][street]" value="{{$address['street'] ?? ''}}" class="form-control form-control-sm street-input">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <div class="form-group mb-2"><label class="small font-weight-bold mb-1">Nº</label><input type="text" name="addresses[{{$index}}][number]" value="{{$address['number'] ?? ''}}" class="form-control form-control-sm"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2"><label class="small font-weight-bold mb-1">Complemento</label><input type="text" name="addresses[{{$index}}][complement]" value="{{$address['complement'] ?? ''}}" class="form-control form-control-sm"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2"><label class="small font-weight-bold mb-1">Bairro</label><input type="text" name="addresses[{{$index}}][district]" value="{{$address['district'] ?? ''}}" class="form-control form-control-sm district-input"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2"><label class="small font-weight-bold mb-1">Cidade</label><input type="text" name="addresses[{{$index}}][city]" value="{{$address['city'] ?? ''}}" class="form-control form-control-sm city-input"></div>
                    </div>
                </div>
                <div class="row mt-2 align-items-end">
                    <div class="col-md-2">
                        <div class="form-group mb-2"><label class="small font-weight-bold mb-1">UF</label><input type="text" name="addresses[{{$index}}][state]" value="{{$address['state'] ?? ''}}" class="form-control form-control-sm state-input"></div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="addresses[{{$index}}][is_primary]" value="1" class="custom-control-input" id="addr_pri_{{$index}}" {{ ($address['is_primary'] ?? false) ? 'checked' : '' }}>
                            <label class="custom-control-label small" for="addr_pri_{{$index}}">Principal</label>
                        </div>
                    </div>
                    <div class="col-md-7 text-right mb-2">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-dynamic">Remover Endereço</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @endcomponent
    </div>
</div>

<div class="form-group text-right">
    <button type="submit" class="btn btn-primary btn-lg">
        {{ modelAction($type, 'save') }}
    </button>
</div>
@endsection

@push('js')
<script>
(function() {
    "use strict";

    const wrapInput = (label, content) => `
        <div class="form-group mb-2">
            <label class="small font-weight-bold mb-1">${label}</label>
            ${content}
        </div>`;

    const initializeDynamicForms = () => {
        // Remove listeners antigos para evitar duplicação caso o script rode 2x
        document.querySelectorAll('.btn-add-dynamic').forEach(btn => {
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const type = e.currentTarget.getAttribute('data-target');
                const index = Date.now();
                let html = '';

                if (type === 'phone') {
                    html = `
                    <div class="row phone-row mb-2 align-items-end">
                        <div class="col-md-3">${wrapInput('Tipo', `<select name="phones[${index}][type]" class="form-control form-control-sm">@foreach($phoneTypes as $k => $v) <option value="{{$k}}">{{$v}}</option> @endforeach</select>`)}</div>
                        <div class="col-md-2">${wrapInput('DDD', `<input type="number" name="phones[${index}][ddd]" class="form-control form-control-sm">`)}</div>
                        <div class="col-md-3">${wrapInput('Número', `<input type="number" name="phones[${index}][number]" class="form-control form-control-sm">`)}</div>
                        <div class="col-md-2 mb-3"><div class="custom-control custom-checkbox"><input type="checkbox" name="phones[${index}][is_primary]" value="1" class="custom-control-input" id="phone_pri_${index}"><label class="custom-control-label small" for="phone_pri_${index}">Principal</label></div></div>
                        <div class="col-md-2 mb-2"><button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button></div>
                    </div>`;
                    document.getElementById('phones-wrapper').insertAdjacentHTML('beforeend', html);
                } 
                
                else if (type === 'email') {
                    html = `
                    <div class="row email-row mb-2 align-items-end">
                        <div class="col-md-3">${wrapInput('Tipo', `<select name="emails[${index}][email_type_id]" class="form-control form-control-sm">@foreach($emailTypes as $k => $v) <option value="{{$k}}">{{$v}}</option> @endforeach</select>`)}</div>
                        <div class="col-md-4">${wrapInput('E-mail', `<input type="email" name="emails[${index}][email]" class="form-control form-control-sm">`)}</div>
                        <div class="col-md-3 mb-3 d-flex align-items-center"><div class="custom-control custom-checkbox mr-3"><input type="checkbox" name="emails[${index}][is_primary]" value="1" class="custom-control-input" id="email_pri_${index}"><label class="custom-control-label small" for="email_pri_${index}">Principal</label></div><span class="badge badge-secondary">Novo</span></div>
                        <div class="col-md-2 mb-2"><button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button></div>
                    </div>`;
                    document.getElementById('emails-wrapper').insertAdjacentHTML('beforeend', html);
                } 
                
                else if (type === 'address') {
                    html = `
                    <div class="address-row border p-3 mb-3 rounded bg-light">
                        <div class="row">
                            <div class="col-md-3">${wrapInput('Tipo', `<select name="addresses[${index}][address_type_id]" class="form-control form-control-sm">@foreach($addressTypes as $k => $v) <option value="{{$k}}">{{$v}}</option> @endforeach</select>`)}</div>
                            <div class="col-md-3">${wrapInput('CEP', `<input type="text" name="addresses[${index}][zipcode]" class="form-control form-control-sm zip-input">`)}</div>
                            <div class="col-md-6">${wrapInput('Rua', `<input type="text" name="addresses[${index}][street]" class="form-control form-control-sm street-input">`)}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">${wrapInput('Nº', `<input type="text" name="addresses[${index}][number]" class="form-control form-control-sm">`)}</div>
                            <div class="col-md-4">${wrapInput('Complemento', `<input type="text" name="addresses[${index}][complement]" class="form-control form-control-sm">`)}</div>
                            <div class="col-md-3">${wrapInput('Bairro', `<input type="text" name="addresses[${index}][district]" class="form-control form-control-sm district-input">`)}</div>
                            <div class="col-md-3">${wrapInput('Cidade', `<input type="text" name="addresses[${index}][city]" class="form-control form-control-sm city-input">`)}</div>
                        </div>
                        <div class="row mt-2 align-items-end">
                            <div class="col-md-2">${wrapInput('UF', `<input type="text" name="addresses[${index}][state]" class="form-control form-control-sm state-input">`)}</div>
                            <div class="col-md-3 mb-2"><div class="custom-control custom-checkbox"><input type="checkbox" name="addresses[${index}][is_primary]" value="1" class="custom-control-input" id="addr_pri_${index}"><label class="custom-control-label small" for="addr_pri_${index}">Principal</label></div></div>
                            <div class="col-md-7 text-right mb-2"><button type="button" class="btn btn-danger btn-sm btn-remove-dynamic">Remover Endereço</button></div>
                        </div>
                    </div>`;
                    document.getElementById('addresses-wrapper').insertAdjacentHTML('beforeend', html);
                }else if (type === 'document') {
                    html = `
                    <div class="row document-row mb-2 align-items-end">
                        <div class="col-md-4">${wrapInput('Tipo de Documento', `
                            <select name="documents[${index}][document_type_id]" class="form-control form-control-sm">
                                <option value="">Selecione...</option>
                                @foreach($documentTypes as $k => $v) <option value="{{$k}}">{{$v}}</option> @endforeach
                            </select>`)}
                        </div>
                        <div class="col-md-6">${wrapInput('Número do Documento', `<input type="text" name="documents[${index}][number]" class="form-control form-control-sm">`)}</div>
                        <div class="col-md-2 mb-2">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-dynamic w-100">Remover</button>
                        </div>
                    </div>`;
                    document.getElementById('documents-wrapper').insertAdjacentHTML('beforeend', html);
                }
            });
        });

        // Delegação de cliques para remover
        document.body.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-remove-dynamic');
            if (btn) {
                e.preventDefault();
                const row = btn.closest('.phone-row') || btn.closest('.email-row') || btn.closest('.address-row');
                if (row) row.remove();
            }
        });

        // Consulta CEP Automática (ViaCEP)
        document.body.addEventListener('blur', (e) => {
            if (e.target.classList.contains('zip-input')) {
                const cep = e.target.value.replace(/\D/g, '');
                if (cep.length === 8) {
                    const row = e.target.closest('.address-row');
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(res => res.json())
                        .then(data => {
                            if (!data.erro) {
                                row.querySelector('.street-input').value = data.logradouro;
                                row.querySelector('.district-input').value = data.bairro;
                                row.querySelector('.city-input').value = data.localidade;
                                row.querySelector('.state-input').value = data.uf;
                            }
                        });
                }
            }
        }, true);
    };

    if (document.readyState === "complete" || document.readyState === "interactive") {
        initializeDynamicForms();
    } else {
        document.addEventListener('DOMContentLoaded', initializeDynamicForms);
    }
})();
</script>
@endpush