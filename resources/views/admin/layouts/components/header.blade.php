<div class="d-flex {{ isset($class) ? $class : ''}}">
    <div class="header flex-grow-1">
        <input type="hidden" class="title-hidden" value="{{ $title }}">
        @if(isset($subtitle))
            <h2 class="h4">{{ $subtitle }}</h2>
        @endif
        {{ $slot }}
    </div>
    @if (isset($aside))
        <div class="aside">
            {{ $aside }}
        </div>
    @endif
</div>

@if(isset($breadcrumbs) && !isset($not_display_subtitle))
    <div style="margin-bottom: 2rem;">
        {!! $breadcrumbs->render() !!}
    </div>
@endif

