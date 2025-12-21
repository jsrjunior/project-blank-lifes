<div class="card{{ isset($class) ? ' ' . $class : '' }}">
    <div class="card-header collapsed {{ isset($headerClass) ? ' ' . $headerClass : '' }}" data-toggle="collapse" data-target="#card-body-{{ $uniqueId }}" aria-expanded="true" aria-controls="card-body-{{ $uniqueId }}">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title px-3 pt-2 mb-1">
                    {{ $title }}
                </h5>
                @if(isset($subtitle))
                    <h6 class="card-subtitle">{!! $subtitle !!}</h6>
                @endif
            </div>
            <div class="ml-auto">
                <h5 class="px-3 pt-2 mb-1">
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </h5>
            </div>
            @if(isset($actions) && $actions)
                <div class="flex-shrink-1 text-right">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>

    <div id="card-body-{{ $uniqueId }}" class="collapse card-body{{ isset($bodyClass) ? ' ' . $bodyClass : '' }}">
        {{ $slot }}
    </div>
</div>
