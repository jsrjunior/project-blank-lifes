@php
$totalPages = (int) ceil($paginator->total() / $paginator->perPage());
$limitPages = $paginator->currentPage()+5;
@endphp
<div class="row align-content-center">
    <div class="col-6 col-sm-3">
        <form class="form-inline" method="GET" role="form" action="{{url()->full()}}">
            <div class="form-group" style="position:relative;">
                <label for="perPage" class="text-black-50">{{ __('Itens por página:') }} </label>
                <select class="form-control bg-gray-200 text-dark focus-ring focus-ring-secondary ml-2" id="perPage" name="perPage" onChange="changePerPage(this)">
                    <option {{$paginator->perPage() == 15 ? 'selected' : ''}}>15</option>
                    <option {{$paginator->perPage() == 30 ? 'selected' : ''}}>30</option>
                    <option {{$paginator->perPage() == 50 ? 'selected' : ''}}>50</option>
                </select>
            </div>
        </form>
    </div>

    <div class="d-none d-sm-flex col-6 justify-content-center">
        @if ($paginator->lastPage() > 1)
        <ul class="pagination" role="navigation">
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link text-dark" href="{{ $paginator->url($paginator->currentPage()-1) }}" data-pjax="#main" rel="prev" aria-label="« Anterior">‹</a>
            </li>

            @for ($i = $paginator->currentPage(); $i <= $limitPages; $i++) <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link {{ ($paginator->currentPage() == $i) ? ' text-light' : 'text-dark' }}" href="{{ $paginator->url($i) }}" data-pjax="#main">{{ $i }}</a>
                </li>

                @if($i == $totalPages)
                @break
                @endif
                @endfor

                <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link text-dark" href="{{ $paginator->url($paginator->currentPage()+1) }}" data-pjax="#main" rel="next" aria-label="Próximo »">›</a>
                </li>
        </ul>
        @endif
    </div>

    <div class="col-6 col-sm-3 d-flex justify-content-end">
        <?php if(empty($paginator_got_to_page_off)){ ?>
        <div class="form-group">
            <label for="page" class="text-black-50">{{ __('Ir para a página') }}</label>
            <select class="form-control bg-gray-200 text-dark ml-2 focus-ring focus-ring-secondary" id="page" onChange="redirectToPage()">
                @for($j = 1; $j <= $totalPages; $j++) <option value="{{ $paginator->url($j) }}" {{ $paginator->currentPage() == $j ? 'selected' : '' }}>
                    {{ $j }}
                    </option>
                    @endfor
            </select>
        </div>
        <?php } ?>
    </div>

    <div class="col-12">
        <small><strong>{{$paginator->total()}}</strong> {{ __('Itens listados') }}</small>
    </div>
</div>


<script>
    function redirectToPage() {
        const selectedPageUrl = document.getElementById('page').value;
        window.location.href = selectedPageUrl;
    }

    function changePerPage(el){
        if(location.search.includes('perPage'))
            location.search = location.search.replace(/perPage=\d+/, 'perPage='+el.value)
        else{
            if(!location.search)
                location.search += 'perPage=' + el.value 
            else
                location.search += '&perPage=' + el.value
        }
    }

    (function(){
        const btn_filter = document.querySelectorAll('.btn-grid-crud')
        const perPageValue = document.querySelector('#perPage').value
        Array.from(btn_filter).filter(e=>e.textContent == 'Filtrar').map(function(e){ 
            e.form.action += '?perPage=' + perPageValue
        })
    })()
</script>
