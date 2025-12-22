@section('form')
    @php(html()->model($instance))
    <div class="row">
        <div class="col-12">
            @component('admin.layouts.components.card')
                <div class="row">
                    @slot('title', __('Dados do Status'))
                    <div class="col-sm-12 col-lg-6">
                        @component('admin.layouts.components.form.input_text')
                            @slot('type', $type)
                            @slot('name', 'name')
                            @slot('required', true)
                        @endcomponent
                    </div>

                    @component('admin.layouts.components.form.input_date')
                            @slot('type', $type)
                            @slot('name', 'birth_date')
                            @slot('required', true)
                        @endcomponent
                </div>
            @endcomponent
        </div>
        @if (
            !strpos(request()->route()->getName(),
                'show'))
            <div class="col-12">
                <div class="form-group">
                    {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
                </div>
            </div>
        @endif
    </div>
    @php(html()->endModel())
@endsection
