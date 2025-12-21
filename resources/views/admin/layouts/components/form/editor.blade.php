<div class="form-group ckeditors {{ isset($required) && $required ? 'required' : ''  }}">
    {{ html()->label($label ?? modelAttribute($type, $name), $name) }}
    {!! $label_after ?? '' !!}
    {{ html()->textarea($name, isset($value) ? $value : null)
        ->class(['form-control', 'is-invalid' => $errors->has($name)])
        ->attributeIf($required ?? false, 'required')
        ->attribute('rows', 10) }}
    @include('admin.layouts.components.form.errors')
    {{ $slot }}
</div>

@pushonce('scripts:templates')
    @include('admin.layouts.partials.editor-templates')
@endpushonce

@push('scripts')
    <script>
        $(function() {
            var ckeditorConfig = {
                @if(isset($basic) && $basic)
                toolbar: [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] }
                ],
                @endif
                fullPage: true,
                removeButtons: '',
                height: {{ $height ?? 500 }},
                extraPlugins: 'wordcount,notification,justify,colorbutton,pastefromword,uploadimage,image2,codemirror,template,videoembed,ckawesome',
                allowedContent: {
                    $1: {
                        elements: CKEDITOR.dtd,
                        attributes: true,
                        styles: true,
                        classes: true
                    }
                },
                disallowedContent: 'span{font-family,font-size};' +
                    '*{margin};*{font*};' +
                    'table[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'td[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'tr[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign];' +
                    'col[width,height,data-sheets-formula,data-sheets-value,data-sheets-numberformat,style,align,border,cellspacing,class,nowrap,valign]',

                filebrowserImageBrowseUrl: '{{ route('web.admin.gallery.browser') }}',

                imageUploadUrl: '{{ route('web.admin.gallery.fileupload') }}',

                stylesSet: [
                    { name: 'Legenda de imagem', element: 'span', attributes: { 'class': 'figcaption' } },
                    { name: 'Header tabela', element: 'td', attributes: { 'class': 'table-header' } },
                    { name: 'Remover quebra', element: 'td', attributes: { 'class': 'nowrap' } },
                ],

                contentsCss: [ CKEDITOR.basePath + 'contents.css', '/css/admin/widgetstyles.css', '{{ mix("/css/frontend/app-ckeditor.css") }}' ],

                image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right'],
                image2_disableResizer: true,
                codemirror: {
                    theme: 'monokai',
                    enableCodeFormatting: true,
                    autoFormatOnStart: true,
                    autoFormatOnModeChange: true
                },
                template: {
                    templates: [
                        {
                            name: 'cta-inline',
                            label: 'CTA',
                            template: $('#cta-inline-template').html()
                        },
                        {
                            name: 'cta-block',
                            label: 'CTA Bloco',
                            template: $('#cta-block-template').html()
                        },
                        {
                            name: 'block-editor-note',
                            label: 'Nota do Editor',
                            template: $('#block-editor-note-template').html()
                        },
                        {
                            name: 'block-podcasts',
                            label: 'Bloco podcasts',
                            template: $('#block-podcasts').html()
                        }
                    ]
                },
                wordcount: {
                    showRemaining: true,
                    showParagraphs: false,
                    showWordCount: false,
                    showCharCount: true,
                    countSpacesAsChars: true,
                    hardLimit: true,
                    maxWordCount: -1,
                    maxCharCount: -1,
                    maxParagraphs: -1,
                },
                fontawesomePath : '/css/admin/app.css'
            };

            CKEDITOR.plugins.addExternal('codemirror', '/js/ckeditor/plugins/codemirror/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('template', '/js/ckeditor/plugins/template/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('videoembed', '/js/ckeditor/plugins/videoembed/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('ckawesome', '/js/ckeditor/plugins/ckawesome/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('image2', '/js/ckeditor/plugins/image2/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('wordcount', '/js/ckeditor/plugins/wordcount/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('notification', '/js/ckeditor/plugins/notification/', 'plugin.js' );

            window.editor_{{ $name }} = CKEDITOR.replace('{{ $name }}', ckeditorConfig);

            let errors = {};
	        let activeRequest = null;

            window.editor_{{ $name }}.on('blur', function(event) {
                // _validateField
                let field = $('#{{ $name }}');
		        let form = field.parents('form');
                if ("" !== form.data('validation')) {
                    field.data('touched', true);

                    // _sendValidationRequest
                    field.val(window.editor_{{ $name }}.getData());

                    let data = form.serialize();
                    let url = form.data('validation');
                    let method = form.attr('method') || 'GET';

                    field.addClass('is-loading');

                    activeRequest && activeRequest.abort();

                    activeRequest = $.ajax({
                        method,
                        url,
                        data,
                        success() {
                            errors = {};
                        },
                        error(error) {
                            errors = error.responseJSON.errors;
                        },
                        complete(xhr, status) {
                            if (status === 'success' || status === 'error') {
                                //_updateAllIcons
                                form.find('input, select, textarea').each((index, item) => {
                                    let field = $(item);

                                    if (field.data('touched')) {
                                        // _updateIcon
                                        let type = (field.attr('name') in errors) ? 'invalid' : 'valid';

                                        field
                                            .removeClass('is-loading')
                                            .removeClass('is-invalid')
                                            .removeClass('is-valid')
                                            .addClass('is-' + type);
                                    }
                                });

                                // _updateAllMessages
                                messages = errors;
                                form.find('input, select, textarea').each((index, item) => {
                                    let field = $(item);
                                    let message = messages[field.attr('name')];
                                    if (field.data('touched')) {
                                        //_updateMessage
                                        let type = (field.attr('name') in errors) ? 'invalid' : 'valid';
                                        let fieldClasses = `.validation-input-${field.attr('name')}`;

                                        $(fieldClasses).addClass(type+'-feedback');

                                        if(type === 'valid'){
                                            $(fieldClasses+' strong').text('');
                                        }else{
                                            $(fieldClasses+' strong').text(message[0]);
                                        }
                                    }
                                });
                            }

                            activeRequest = null;
                        }
                    });

                    // _createMessageSpan
                    var spansFeedback = $(field).closest('.form-group').find('.invalid-feedback, .valid-feedback, .loading-feedback');

                    if(spansFeedback.length==0){
                        $(field).after(`<span class='validation-input-${$(field).attr('name')} invalid-feedback'><strong></strong></span>`);
                    }else{
                        spansFeedback.each(function(){

                            $(this).addClass(`validation-input-${$(this).attr('name')}`);
                        });
                    }
                }
            });
        });
    </script>
@endpush
