<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>


<script>
    Dropzone.autoDiscover = false;
    Dropzone.options.mediaDropzone = {
        parallelUploads: 1,
        dictDefaultMessage: "Clique ou arraste uma imagem para enviar",
        init: function () {
            this.on("queuecomplete", function (file) {
                location.reload();
            });
        }
    };

    $(function() {
    	initBootstrap();
    	initFormAnchors();
    	initFormSubmit();
    	initFormAddress();
    	initFormValidation();
    	initSlugWatch();
    	initDatetimepicker();
    	initMask();
    	initHighlightjs();
        initUserNotifications();

    });

    $('.title-hidden').ready(function() {
        if($('.title-hidden').val() !== undefined){
            var label = $('.title-hidden').val();
                label = label.trim();
            $('.topbar-title').text(label);
        }
    });

   
    function toggleDetails(item)
    {
        if (item !== 0)
        {
            const hiddenContents = document.querySelectorAll('.hidden-content_' + item);

            const formHistory = document.querySelector('.form-history-' + item);

            if (formHistory)
            {
                interactionHistory(formHistory, item);
            }

            // Converta hiddenContents para um array usando Array.from()
            const hiddenContentsArray = Array.from(hiddenContents);

            // Percorra todos os elementos com class iniciada em .hidden-content_
            document.querySelectorAll('[class^="hidden-content_"]').forEach(_content => {
                // Verifique se o elemento não está em hiddenContentsArray usando includes()
                if (!hiddenContentsArray.includes(_content))
                {
                    _content.style.display = 'none';
                }
            });

            // Alterne o estilo display dos elementos em hiddenContents
            hiddenContents.forEach(_content => {
                _content.style.display = _content.style.display === 'block' ? 'none' : 'block';
            });
        } else
        {
            console.log('function funcionando');
        }
    }


    function dispatchSwal(type, title, html) {
        Swal.fire({
            title: title,  // O título da mensagem de sucesso
            html: html,
            imageUrl: '/img/admin/alerts/modal_'+type+'.png',           // O ícone para sucesso (pode ser 'success', 'error', 'warning', 'info' etc.)
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

    // NOTE: General Modal MAIN FUNCTION
    function generalModalToogle(title, confirmMessage, bodyFunction, params = null) {
        $('#generalModalTitle').empty();
        $('#generalModalBody').empty();
        $('#generalModalConfirmMessage').empty();

        $('#generalModal').modal('toggle');
        $('#generalModal').css('opacity', '1');
        $('#generalModalTitle').text(title);
        $('#generalModalConfirmMessage').append(confirmMessage);

        // Monta a função que está sendo chamada na variável bodyFunction
        // e passa o parâmetro param
        window[bodyFunction](params);
    }

    function hideAllContains(div) {
        var divs = document.querySelectorAll('[id^="'+div+'"]');
        divs.forEach(_div => {
            _div.style.display = 'none';
        });
    }

    function toogleDivById(id) {
        var div = document.getElementById(id);
        if (div.style.display === 'none') {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    }

    

</script>
@yield('scripts')
@stack('scripts')