@php($collapse = request()->has('q'))

<div class="collapse {{ $collapse ? 'show' : '' }}" id="card-filter-crud">
    <div class="card border-0 mb-4 rounded-8">
        <div class="card-body">
            <div class="row">
                <div class="col-1 d-none d-sm-block">
                    <h4>Filtros</h4>
                </div>
                <div class="col-12 col-sm-11">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
