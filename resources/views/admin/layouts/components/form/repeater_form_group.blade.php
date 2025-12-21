@php($name = $listName . '_group')
@php($show = isset($show) ? $show : '')
<div class="repeater {{ $listName }}">
    <div data-repeater-list="{{ $listName }}_group">
        {{ $slot }}
    </div>
    <button class="btn btn-secondary btn-lg mt-2" type="button" data-repeater-create>Adicionar</button>
    @if ($errors->has($name))
        <div class="mt-3 p-2" role="alert">
            @foreach ($errors->get($name) as $error)
                @if (!$loop->first)
                    <br>
                @endif
                <strong class="text-danger">{{ $error }}</strong>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $(function() {
            $('.repeater.{{ $listName }}').repeater({
                show: function() {
                    $(this).slideDown();
                    initMask();
                    {{ $show }}
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endpush
