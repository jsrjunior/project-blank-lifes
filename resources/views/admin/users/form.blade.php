@section('form')
    @php(html()->model($instance))
    @php($profile = $instance?->person?->profile)
    @php($phone = $instance?->person?->phones()->first())
    @php($address = $instance?->person?->addresses()->first())
    @php($document = $profile?->documents?->first())

    <div class="row">
        <div class="col-lg-12">
            @component('admin.layouts.components.card')
                @slot('title', __('Dados básicos'))

                
            @endcomponent

            <div class="form-group">
                {{ html()->submit(modelAction($type, 'save'))->class('btn btn-primary btn-lg') }}
            </div>
        </div>
    </div>

    @php(html()->endModel())

@endsection
