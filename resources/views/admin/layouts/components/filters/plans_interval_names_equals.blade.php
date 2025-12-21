@php
$intervals = [];
$intervals = modelAttribute(App\Models\Plan::class, 'options.interval_count');
$intervals[9999999] = modelAttribute(App\Models\Plan::class, 'options.interval.lifetime');

@endphp
<div class="form-group">
    {{ html()->label(__('Tipo de recorrência'), 'interval_names') }}
    {{
        html()
            ->multiselect(
                'interval_names',
                $intervals,
                request()->input('interval_names')
            )
            ->id('interval_names')
            ->class('form-control')
    }}
</div>
@push('scripts')
<script>
    $(function() {
        $('#interval_names').select2();
    });
</script>
@endpush
