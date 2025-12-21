@php
    $randonModalId = rand();
@endphp

<div class="modal fade" id="{{'Modal'.$randonModalId}}" tabindex="-1" role="dialog" aria-labelledby="{{'ModalLabel'.$randonModalId}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="{{'ModalLabel'.$randonModalId}}">Seleção de variáveis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            @component('admin.layouts.components.form.select')
                @slot('type', $type)
                @slot('id', 'variable_id')
                @slot('name', 'variable_id')
                @slot('options', $variables)
                @slot('style', '')
            @endcomponent
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não inserir</button>
            <button id="insert-variable" type="button" class="btn btn-primary">Inserir variável</button>
        </div>
    </div>
    </div>
</div>

@push('scripts')
    <script>
        function showModel(modules, load) {
            let url = encodeURI('{{env('APP_URL')}}/modules/models?modules='+modules);
            axios.get(
                url,
                {
                    headers: {
                        "X-CSRFToken": "{{ csrf_token() }}"
                    }
                }
            )
            .then(function (response) {
                let options = response.data;
                $('#model_type').empty();

                Object.keys(options).forEach(function (key) {
                    if (load && key.replaceAll('\\', '') == "{{$instance->model_type}}") {
                        $('#model_type').append($('<option></option>').attr('selected', true).attr('value', key).text(options[key]));
                    } else {
                        $('#model_type').append($('<option></option>').attr('value', key).text(options[key]));
                    }
                });
            })
            .catch(function (error) {
                console.log(error);
            });
        }

        function insertTextAtCursor(input, text) {
            var startPos = input.selectionStart;
            var endPos = input.selectionEnd;
            var currentValue = input.value;

            input.value = currentValue.substring(0, startPos) + text + currentValue.substring(endPos, currentValue.length);
            input.setSelectionRange(startPos + text.length, startPos + text.length);
        }

        function updateColumnsInModal(model, load) {
            let url = encodeURI('{{env('APP_URL')}}/variables/'+model+'/list');
            axios.get(
                url,
                {
                    headers: {
                        "X-CSRFToken": "{{ csrf_token() }}"
                    }
                }
            )
            .then(function (response) {
                let options = response.data;
                $('#variable_id').empty();

                Object.keys(options).forEach(function (key) {
                    $('#variable_id').append($('<option></option>').attr('value', key).text(options[key]));
                });

                if (load) {
                    $('#variable_id').val('{{$instance->model_type}}');
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        }

        $(document).ready(function() {
            updateColumnsInModal('{{str_replace("\\", "\\\\", $instance->model_type)}}', true);

            $("#model_type").on('change', function(event) {
                updateColumnsInModal($("#model_type").val(), false);
            });

            $('#content').on('keypress', function(event) {
                if (event.key === '{') {
                    $("#{{'Modal'.$randonModalId}}").modal('show');
                    event.preventDefault();
                }
            });

            $("#insert-variable").click(function(event) {
                var variable = $('#variable_id').val();
                var content = document.getElementById('content');
                if (variable) {
                    var selectElement = document.getElementById('variable_id');
                    var selected = selectElement.options[selectElement.selectedIndex].text;
                    if (selected.length > 0) {
                        selected = '{'+selected+'}';
                    }
                    insertTextAtCursor(content, selected);
                    $('#variable_id').val('')

                    $("#{{'Modal'.$randonModalId}}").modal('hide');
                } else {
                    Swal.fire({
                            title: 'Atenção',  // O título da mensagem de sucesso
                            html: 'Selecione uma variável para inserir no conteúdo.',
                            imageUrl: '/img/admin/alerts/modal_warning.png',           // O ícone para sucesso (pode ser 'success', 'error', 'warning', 'info' etc.)
                            imageClass: "img-fluid",
                            showCancelButton: false,    // Não mostrar botão de cancelar
                            confirmButtonColor: '#621587',  // Cor do botão de confirmação (verde para sucesso)
                            confirmButtonText: 'OK',    // Texto do botão de confirmação
                            allowOutsideClick: false,   // Não permitir que o usuário clique fora da caixa de alerta para fechá-la
                            reverseButtons: true,       // Inverter a ordem dos botões (confirmar à esquerda, cancelar à direita)
                            customClass: {
                            confirmButton: 'btn btn-success',   // Classe do botão de confirmação
                            },
                        });
                }
            });
        });
    </script>
@endpush
