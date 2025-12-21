<a class="nav-link index-{{$index}} pl-{{$pl}} {{ sameRoutePrefix(data_get($link, 'route')) ? 'active' : '' }}"
   href="{{data_get($link, 'route') ? route(data_get($link, 'route')) : (data_get($link, 'href') ? data_get($link, 'href') :  data_get($link, 'url'))}}"
   role="button" target="{{!array_key_exists('route', $link) ? '_blank' : '_self'}}">
    <div class="align-items-center d-flex w-auto" style="gap: 0.5rem">
        @if(array_key_exists('icon_svg', $link))
            {!! data_get($link, 'icon_svg') !!}
        @else
            <i class="{{data_get($link, 'icon')}}"></i>
        @endif
        <span class="nav-link-title">{{data_get($link, 'title')}}</span>
    </div>
</a>

@if (data_get($link, 'collapse'))
    @component('admin.layouts.components.menu.nav-collapse')
        @foreach(data_get($link, 'items') as $item)
            @component('admin.layouts.components.menu.nav-item')
                @slot('link', $item)
                @slot('pl', $pl + 1)
                @slot('index', $index + 1)
            @endcomponent
        @endforeach
        @slot('id', data_get($link, 'id'))
    @endcomponent
@endif
