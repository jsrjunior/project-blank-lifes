<script>
    $(function () {
        moment.updateLocale('pt-br', {
            months: 'Janeiro_Fevereiro_Março_Abril_Maio_Junho_Julho_Agosto_Setembro_Outubro_Novembro_Dezembro'.split('_'),
            monthsShort: 'Jan_Fev_Mar_Abr_Mai_Jun_Jul_Ago_Set_Out_Nov_Dez'.split('_'),
            weekdays: 'Domingo_Segunda-feira_Terça-feira_Quarta-feira_Quinta-feira_Sexta-feira_Sábado'.split('_'),
            weekdaysShort: 'Dom_Seg_Ter_Qua_Qui_Sex_Sáb'.split('_'),
            weekdaysMin: 'Do_2ª_3ª_4ª_5ª_6ª_Sá'.split('_'),
            longDateFormat: {
                LT: 'HH:mm',
                LTS: 'HH:mm:ss',
                L: 'DD/MM/YYYY',
                LL: 'D [de] MMMM [de] YYYY',
                LLL: 'D [de] MMMM [de] YYYY [às] HH:mm',
                LLLL: 'dddd, D [de] MMMM [de] YYYY [às] HH:mm'
            }
        });
        moment.locale('pt-br');
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