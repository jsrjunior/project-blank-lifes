<div class="form-group">
    {{ html()->label(__('Pré-header'), 'q[preheader][contains]') }}
    {{ html()->text('q[preheader][contains]', request()->input('q.preheader.contains'))->class('form-control') }}
</div>
