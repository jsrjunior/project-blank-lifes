@if ((! isset($policy)) || $policy)
    <li class="sidebar-item{{ isset($active) && $active ? ' active' : '' }}{{ isset($active_force) && $active_force ? ' active-force' : '' }} without-submenu">
        <a href="{{ $url }}" class="sidebar-link d-flex align-items-center" {{ $pjax ? 'data-pjax' : '' }}>
            @if(isset($icon) && $icon)
                <span class="icon flex-shrink-0"><i class="{{ $icon }}"></i></span>
            @endif

            <span class="flex-grow-1">{{ $label }}</span>
        </a>
    </li>
@endif
