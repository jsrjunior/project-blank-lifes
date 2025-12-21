@if(app('breadcrumbs')->has())
    <ol {!! app('breadcrumbs')->getAttributes() !!}>
        @foreach(app('breadcrumbs')->all() as $crumb)
            <li class="breadcrumb-item">
                @if($crumb['url'])
                    <a href="{{ $crumb['url'] }}">{{ $crumb['title'] }}</a>
                @else
                    {{ $crumb['title'] }}
                @endif
            </li>
        @endforeach
    </ol>
@endif