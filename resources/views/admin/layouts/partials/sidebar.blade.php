@php
    $menu = filterItemsWithPermissions(config('menu'));
@endphp

<nav class="sidebar sidebar-sticky" role="navigation">

    <div class="sidebar-content js-simplebar">
        <div class="sidebar-head">
            <div class="row">
                <div class="side-brand col d-flex align-items-center my-1 justify-content-center">
                    <a class="sidebar-brand" href="{{ route('web.admin.users.edit', ['id' => user()->id]) }}">
                        @if(config('admin.amar_icon_white'))
                            <img src="{{ config('admin.amar_icon') }}" style="width: 120px;" class="align-middle mr-1"/>
                        @endif
                        <span class="align-middle">{{ config('app.short_name') }}</span>
                    </a>
                </div>
                {{-- <div class="col d-flex align-items-center justify-content-end d-block d-lg-none mr-2">
                    <a href="#" class="sidebar-toggle d-flex" style="text-decoration: none;">
                        <i class="fas fa-times align-self-center" style="font-size:1.5rem; color:#9699AC"></i>
                    </a>
                </div> --}}
            </div>

            {{-- <div class="sidebar-search">
                <input class="form-control sidebar-search-input" placeholder="Buscar menu (Ctrl + B)" autocomplete="off" name="sidebar-search-input" type="text">
            </div> --}}
        </div>

        @component('admin.layouts.components.menu.nav')
            @foreach($menu as $section)
                @component('admin.layouts.components.menu.nav-item')
                    @slot('section', $section)
                    @slot('can', collect($section))
                    @slot('index', 0)
                    @slot('pl', 3)
                @endcomponent
            @endforeach
        @endcomponent

    </div>
</nav>

@push('scripts')
    <script>
        $(function () {
            $(".sidebar-search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".sidebar-nav>li").filter(function () {
                    text = value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                    $(this).toggle(
                        $(this).text().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").indexOf(text) > -1
                    );
                });
            });

            document.onkeyup = function (e) {
                // Ctrl + b
                if (e.ctrlKey && e.which == 66) {
                    $(".sidebar-search-input").focus();
                }
            };

            $('.without-submenu').on('click', function (event) {
                $('.sidebar').removeClass('toggled');
            });

            $('.angle-box').on('click', function (event) {
                $(this).toggleClass('rotated-180');
            });


            // NOTE: Download via ajax
            $(".btn-download").on("click", function () {
                var url = $(this).attr('data-url');

                if (url !== undefined) {
                    var matches = url.match(/\/([^/]+)\/download/);
                    var resourceName = matches[1];
                    var fileName = resourceName !== undefined ? resourceName : 'download';
                    fileName = fileName + '_' + moment().format('DD-MM-YYYY_HH:mm:ss') + '.csv';

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    });

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (response) {
                            // Extrai os dados CSV do objeto de resposta
                            var csvData = response;

                            // Cria um Blob com os dados CSV
                            var blob = new Blob([csvData], {type: 'text/csv'});

                            // Cria uma URL temporária para o Blob
                            var url = window.URL.createObjectURL(blob);

                            // Cria um elemento de link para iniciar o download
                            var a = document.createElement('a');
                            a.href = url;
                            a.download = fileName;

                            // Simula um clique no link para iniciar o download
                            a.click();

                            // Limpa a URL temporária
                            window.URL.revokeObjectURL(url);

                            toastr.success('Download concluído', 'Sucesso');
                        },
                        error: function (xhr, status, error) {
                            toastr.error('Tente novamente', 'Erro no download');
                        }
                    });
                }
            });
        });
    </script>
@endpush
