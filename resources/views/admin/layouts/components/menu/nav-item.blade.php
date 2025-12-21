<div class="nav-item index-{{$index}} {{ sameRoutePrefix(data_get($section, 'route')) ? 'active' : '' }}">
    @if(data_get($section, 'collapse'))
        <a class="nav-link dropdown-toggle collapsed index-{{$index}} pl-{{$pl}}" href="#{{data_get($section, 'id')}}"
           data-toggle="collapse"
           role="button"
           data-bs-toggle="collapse" data-bs-target="#{{data_get($section, 'id')}}" aria-expanded="false"
           aria-controls="{{data_get($section, 'id')}}">
            <div class="align-items-center d-flex w-auto" style="gap: 0.5rem">
                @if(array_key_exists('icon_svg', $section))
                    {!! data_get($section, 'icon_svg') !!}
                @else
                    <i class="{{data_get($section, 'icon')}}"></i>
                @endif
                <span class="nav-link-title">{{data_get($section, 'title')}}</span>
            </div>
        </a>
    @endif

    @if (data_get($section, 'collapse'))
        @component('admin.layouts.components.menu.nav-collapse')
            @foreach(data_get($section, 'items') as $key => $item)
                @if (data_get($item, 'collapse'))
                    @component('admin.layouts.components.menu.nav-item')
                        @slot('section', $item)
                        @slot('pl', $pl + 1)
                        @slot('index', $index + 1)
                    @endcomponent
                @else
                    @component('admin.layouts.components.menu.nav-link')
                        @slot('link', $item)
                        @slot('pl', $pl + 1)
                        @slot('index', $index + 1)
                    @endcomponent
                @endif

            @endforeach
            @slot('id', data_get($section, 'id'))
        @endcomponent
    @else
        @if ($index === 0)
            @component('admin.layouts.components.menu.nav-link')
                @slot('link', $section)
                @slot('pl', $pl)
                @slot('index', $index)
            @endcomponent
        @else
            @component('admin.layouts.components.menu.nav-link')
                @slot('link', $section)
                @slot('pl', $pl + 1)
                @slot('index', $index + 1)
            @endcomponent
        @endif
    @endif
</div>
