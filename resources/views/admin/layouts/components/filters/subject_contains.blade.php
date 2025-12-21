<div class="form-group">
    {{ html()->label(__($title ?? 'Assunto'), 'q[subject][contains]') }}
    {{ html()->text('q[subject][contains]', request()->input('q.subject.contains'))->class('form-control') }}
</div>
