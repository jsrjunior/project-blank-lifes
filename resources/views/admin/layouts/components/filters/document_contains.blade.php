<div class="form-group">
    {{ html()->label(__('Documento'), 'q[document][contains]') }}
    {{ html()->text('q[document][contains]', request()->input('q.document.contains'))->class('form-control') }}
</div>
